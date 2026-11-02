<?php

declare(strict_types=1);

require_once __DIR__ . '/unidad-de-trabajo.php';
require_once __DIR__ . '/comandos.php';

// mensajeria.php — EL BUS distingue COMANDOS de EVENTOS (cap. 10):
//   - Comando: UN solo manejador; si falla, el error PROPAGA (fail fast, burbujea).
//   - Evento: VARIOS manejadores; si uno falla, se AÍSLA (no interrumpe el flujo).
// Reparte según `instanceof Comando`. Mantiene DOS mapas (comando y evento).

final class SkuInvalido extends \Exception {}

final class Registros
{
    /** @var string[] */
    public static array $notificacionesSinStock = [];
    /** @var string[] */
    public static array $asignacionesRegistradas = [];
}

// Los dos mapas viven como registro mutable (como los dicts a nivel de módulo del libro):
// así un test puede añadir un manejador de evento que reviente y comprobar el aislamiento.
final class Bus
{
    /** @var array<class-string, callable> */
    public static array $comando = [];
    /** @var array<class-string, callable[]> */
    public static array $evento = [];
}

function configurarBus(): void
{
    Bus::$comando = [
        Asignar::class => 'asignar',
        CrearLote::class => 'crearLote',
        CambiarCantidadLote::class => 'cambiarCantidadLote',
    ];
    Bus::$evento = [
        SinStock::class => ['notificarSinStock'],
        Asignado::class => ['registrarAsignacion'],
        Desasignado::class => ['reasignar'],
    ];
}

/** @return array<int, mixed> */
function manejar(Comando|Evento $mensaje, UnidadDeTrabajo $uow): array
{
    if (Bus::$comando === []) {
        configurarBus();
    }
    $resultados = [];
    $cola = [$mensaje];
    while ($cola !== []) {
        $m = array_shift($cola);
        if ($m instanceof Comando) {
            $resultados[] = manejarComando($m, $cola, $uow); // puede propagar
        } else {
            manejarEvento($m, $cola, $uow);                  // errores aislados
        }
    }
    return $resultados;
}

// Comando: un handler. Si lanza, NO lo atrapamos: el error sube a quien dio la orden.
function manejarComando(Comando $comando, array &$cola, UnidadDeTrabajo $uow): mixed
{
    $manejador = Bus::$comando[$comando::class];
    $resultado = $manejador($comando, $uow); // si falla, PROPAGA
    foreach ($uow->recolectarEventosNuevos() as $nuevo) {
        $cola[] = $nuevo;
    }
    return $resultado;
}

// Evento: varios handlers, cada uno en try/catch. Un fallo se registra y se sigue.
function manejarEvento(Evento $evento, array &$cola, UnidadDeTrabajo $uow): void
{
    foreach (Bus::$evento[$evento::class] ?? [] as $manejador) {
        try {
            $manejador($evento, $uow);
            foreach ($uow->recolectarEventosNuevos() as $nuevo) {
                $cola[] = $nuevo;
            }
        } catch (\Throwable) {
            continue; // AISLADO: no rompe el procesamiento del resto
        }
    }
}

// --- Handlers de COMANDOS ---

function asignar(Asignar $comando, UnidadDeTrabajo $uow): ?string
{
    $producto = $uow->productos()->obtener($comando->sku);
    if ($producto === null) {
        throw new SkuInvalido("Sku inválido {$comando->sku}");
    }
    $linea = LineaPedido::create([
        'id_pedido' => $comando->idPedido,
        'sku' => $comando->sku,
        'cantidad' => $comando->cantidad,
    ]);
    $referencia = $producto->asignar($linea);
    $uow->comprometer();
    return $referencia;
}

function crearLote(CrearLote $comando, UnidadDeTrabajo $uow): void
{
    $producto = $uow->productos()->obtener($comando->sku);
    if ($producto === null) {
        $producto = new Producto(['sku' => $comando->sku]);
        $uow->productos()->agregar($producto);
    }
    $producto->lotes()->create([
        'referencia' => $comando->referencia,
        'sku' => $comando->sku,
        'cantidad_comprada' => $comando->cantidad,
        'eta' => $comando->eta,
    ]);
    $uow->comprometer();
}

function cambiarCantidadLote(CambiarCantidadLote $comando, UnidadDeTrabajo $uow): void
{
    $lote = Lote::where('referencia', $comando->referencia)->first();
    $producto = $uow->productos()->obtener($lote->producto_sku);
    $producto->cambiarCantidadLote($comando->referencia, $comando->cantidad);
    $uow->comprometer();
}

// --- Handlers de EVENTOS ---

function notificarSinStock(SinStock $evento, UnidadDeTrabajo $uow): void
{
    Registros::$notificacionesSinStock[] = $evento->sku;
}

function registrarAsignacion(Asignado $evento, UnidadDeTrabajo $uow): void
{
    Registros::$asignacionesRegistradas[] = $evento->referencia;
}

function reasignar(Desasignado $evento, UnidadDeTrabajo $uow): void
{
    $producto = $uow->productos()->obtener($evento->sku);
    $linea = LineaPedido::create([
        'id_pedido' => $evento->idPedido,
        'sku' => $evento->sku,
        'cantidad' => $evento->cantidad,
    ]);
    $producto->asignar($linea);
    $uow->comprometer();
}
