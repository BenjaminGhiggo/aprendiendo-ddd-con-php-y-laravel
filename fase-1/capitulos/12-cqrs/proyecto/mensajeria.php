<?php

declare(strict_types=1);

require_once __DIR__ . '/comandos.php';
require_once __DIR__ . '/eventos.php';
require_once __DIR__ . '/cola-externa.php';
require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/unidad-de-trabajo.php';
require_once __DIR__ . '/vistas.php';

use Illuminate\Database\Capsule\Manager as Capsule;

final class SkuInvalido extends \Exception {}

// mensajeria.php — el BUS DE MENSAJES. Distingue COMANDOS de EVENTOS:
//   - comando: UN handler; si falla, el error PROPAGA.
//   - evento: VARIOS handlers; si uno falla, se AÍSLA (no rompe el flujo).
// En Python los HANDLERS son un dict con la CLASE como clave. En PHP la clave de un array debe
// ser string/int, así que usamos el NOMBRE de la clase (`Clase::class`) como clave, y
// `$mensaje::class` (o get_class) lo recupera. Los handlers son callables [Bus::class, 'metodo'].
final class Bus
{
    /** @var string[] efectos observables para los tests */
    public static array $notificacionesSinStock = [];
    /** @var string[] */
    public static array $asignacionesRegistradas = [];

    /** @return array<string, callable> comando::class => handler */
    public static function manejadoresComando(): array
    {
        return [
            Asignar::class => [self::class, 'asignar'],
            CrearLote::class => [self::class, 'crearLote'],
            CambiarCantidadLote::class => [self::class, 'cambiarCantidadLote'],
        ];
    }

    /** @return array<string, callable[]> evento::class => [handlers] */
    public static function manejadoresEvento(): array
    {
        return [
            EventoSinStock::class => [[self::class, 'notificarSinStock']],
            Asignado::class => [[self::class, 'registrarAsignacion'], [self::class, 'publicarAsignadoAlExterior'], [self::class, 'agregarAsignacionAVista']],
            Desasignado::class => [[self::class, 'reasignar']],
        ];
    }

    /** @return array<int, mixed> */
    public static function manejar(Comando|Evento $mensaje, UnidadDeTrabajo $uow): array
    {
        $resultados = [];
        $cola = [$mensaje];
        while ($cola !== []) {
            $m = array_shift($cola);
            if ($m instanceof Comando) {
                $resultados[] = self::manejarComando($m, $uow, $cola);
            } else {
                self::manejarEvento($m, $uow, $cola);
            }
        }
        return $resultados;
    }

    private static function manejarComando(Comando $comando, UnidadDeTrabajo $uow, array &$cola): mixed
    {
        $handler = self::manejadoresComando()[$comando::class] ?? null;
        if ($handler === null) {
            throw new \RuntimeException('Sin handler para ' . $comando::class);
        }
        $resultado = $handler($comando, $uow); // si falla, PROPAGA
        foreach ($uow->recolectarEventosNuevos() as $e) {
            $cola[] = $e;
        }
        return $resultado;
    }

    private static function manejarEvento(Evento $evento, UnidadDeTrabajo $uow, array &$cola): void
    {
        foreach (self::manejadoresEvento()[$evento::class] ?? [] as $handler) {
            try {
                $handler($evento, $uow);
                foreach ($uow->recolectarEventosNuevos() as $e) {
                    $cola[] = $e;
                }
            } catch (\Throwable) {
                continue; // AISLADO: no rompe el flujo
            }
        }
    }

    // --- handlers de COMANDOS ---
    public static function asignar(Asignar $comando, UnidadDeTrabajo $uow): ?string
    {
        $linea = new LineaPedido($comando->idPedido, $comando->sku, $comando->cantidad);
        $producto = $uow->productos()->obtener($comando->sku);
        if ($producto === null) {
            throw new SkuInvalido("Sku inválido {$comando->sku}");
        }
        $referencia = $producto->asignar($linea);
        $uow->comprometer();
        return $referencia;
    }

    public static function crearLote(CrearLote $comando, UnidadDeTrabajo $uow): void
    {
        $producto = $uow->productos()->obtener($comando->sku);
        if ($producto === null) {
            $producto = Producto::crear($comando->sku, []);
            $uow->productos()->agregar($producto);
        }
        $producto->agregarLote(new Lote([
            'referencia' => $comando->referencia,
            'sku' => $comando->sku,
            'cantidad_comprada' => $comando->cantidad,
            'eta' => $comando->eta,
        ]));
        $uow->comprometer();
    }

    public static function cambiarCantidadLote(CambiarCantidadLote $comando, UnidadDeTrabajo $uow): void
    {
        foreach ($uow->productos()->listar() as $p) {
            foreach ($p->lotes as $l) {
                if ($l->referencia === $comando->referencia) {
                    $uow->productos()->obtener($p->sku); // lo marca como "visto"
                    $p->cambiarCantidadLote($comando->referencia, $comando->cantidad);
                    $uow->comprometer();
                    return;
                }
            }
        }
    }

    // --- handlers de EVENTOS ---
    public static function notificarSinStock(EventoSinStock $evento, UnidadDeTrabajo $uow): void
    {
        self::$notificacionesSinStock[] = $evento->sku;
    }

    public static function registrarAsignacion(Asignado $evento, UnidadDeTrabajo $uow): void
    {
        self::$asignacionesRegistradas[] = $evento->referencia;
    }

    public static function publicarAsignadoAlExterior(Asignado $evento, UnidadDeTrabajo $uow): void
    {
        // EVENTO EXTERNO: avisamos a otros servicios por el canal (Redis en producción).
        ColaExterna::publicar('linea_asignada', [
            'id_pedido' => $evento->idPedido,
            'sku' => $evento->sku,
            'ref' => $evento->referencia,
        ]);
    }

    public static function agregarAsignacionAVista(Asignado $evento, UnidadDeTrabajo $uow): void
    {
        // CQRS: actualizar el modelo de LECTURA cuando se asigna. Un INSERT simple; el GET luego
        // solo hace un SELECT. (Nota de diseño: si la tabla no existe -p. ej. con la UoW falsa sin
        // base de datos- este handler falla, pero el bus AÍSLA los eventos, así que no rompe el comando.)
        Capsule::table('asignaciones_vista')->insert([
            'id_pedido' => $evento->idPedido,
            'sku' => $evento->sku,
            'referencia' => $evento->referencia,
        ]);
    }

    public static function reasignar(Desasignado $evento, UnidadDeTrabajo $uow): void
    {
        $linea = new LineaPedido($evento->idPedido, $evento->sku, $evento->cantidad);
        $producto = $uow->productos()->obtener($evento->sku);
        if ($producto === null) {
            return;
        }
        $producto->asignar($linea);
        $uow->comprometer();
    }

    // ADAPTADOR DE ENTRADA: traduce un mensaje externo (array) a un comando interno.
    /** @param array{referencia: string, cantidad: int} $mensaje */
    public static function consumirExterno(array $mensaje, UnidadDeTrabajo $uow): array
    {
        $comando = new CambiarCantidadLote($mensaje['referencia'], $mensaje['cantidad']);
        return self::manejar($comando, $uow);
    }
}
