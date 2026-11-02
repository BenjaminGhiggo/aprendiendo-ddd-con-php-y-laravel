<?php

declare(strict_types=1);

require_once __DIR__ . '/unidad-de-trabajo.php';

// mensajeria.php — EL BUS ES EL PUNTO DE ENTRADA al servicio (cap. 9).
// Procesa una COLA de mensajes: tras ejecutar cada handler, recoge los eventos NUEVOS que la
// UoW haya acumulado y los encola (cascada). Las funciones de servicio son ahora handlers
// con la firma (mensaje, uow).
//
// En Python: MANEJADORES = { eventos.X: [handler] } y MANEJADORES[type(m)].
// En PHP la clave del array es texto, así que se usa Evento::class y se busca con $m::class.

final class SkuInvalido extends \Exception {}

// Registros para que los tests comprueben qué pasó.
final class Registros
{
    /** @var string[] */
    public static array $notificacionesSinStock = [];
    /** @var string[] */
    public static array $asignacionesRegistradas = [];
}

// El punto de entrada. Recibe un mensaje y una UoW; devuelve los resultados de los handlers.
/** @return array<int, mixed> */
function manejar(Evento $mensaje, UnidadDeTrabajo $uow): array
{
    $resultados = [];
    $cola = [$mensaje];
    while ($cola !== []) {
        $m = array_shift($cola);
        foreach (manejadores()[$m::class] ?? [] as $manejador) {
            $resultados[] = $manejador($m, $uow);
            // Tras cada handler: recoge los eventos nuevos y encólalos (cascada).
            foreach ($uow->recolectarEventosNuevos() as $eventoNuevo) {
                $cola[] = $eventoNuevo;
            }
        }
    }
    return $resultados;
}

// --- Handlers (antes "funciones de servicio") ---

function asignar(AsignacionRequerida $evento, UnidadDeTrabajo $uow): ?string
{
    $producto = $uow->productos()->obtener($evento->sku);
    if ($producto === null) {
        throw new SkuInvalido("Sku inválido {$evento->sku}");
    }
    $linea = LineaPedido::create([
        'id_pedido' => $evento->idPedido,
        'sku' => $evento->sku,
        'cantidad' => $evento->cantidad,
    ]);
    $referencia = $producto->asignar($linea);
    $uow->comprometer();
    return $referencia;
}

function cambiarCantidadLote(CambiarCantidadLote $evento, UnidadDeTrabajo $uow): void
{
    $lote = Lote::where('referencia', $evento->referencia)->first();
    $producto = $uow->productos()->obtener($lote->producto_sku);
    $producto->cambiarCantidadLote($evento->referencia, $evento->cantidad);
    $uow->comprometer();
}

function notificarSinStock(SinStock $evento, UnidadDeTrabajo $uow): void
{
    Registros::$notificacionesSinStock[] = $evento->sku;
}

function registrarAsignacion(Asignado $evento, UnidadDeTrabajo $uow): void
{
    Registros::$asignacionesRegistradas[] = $evento->referencia;
}

/** @return array<class-string, callable[]> */
function manejadores(): array
{
    return [
        AsignacionRequerida::class => ['asignar'],
        CambiarCantidadLote::class => ['cambiarCantidadLote'],
        SinStock::class => ['notificarSinStock'],
        Asignado::class => ['registrarAsignacion'],
    ];
}
