<?php

declare(strict_types=1);

require_once __DIR__ . '/unidad-de-trabajo.php';
require_once __DIR__ . '/mensajeria.php';

// servicios.php — la CAPA DE SERVICIO (casos de uso). Usa la UoW y, tras asignar, PUBLICA los
// eventos que el modelo acumuló pasándolos al bus de mensajes.
final class SkuInvalido extends \Exception {}

function agregarLote(string $referencia, string $sku, int $cantidad, ?string $eta, UnidadDeTrabajo $uow): void
{
    $producto = $uow->productos()->obtener($sku);
    if ($producto === null) {
        $producto = new Producto(['sku' => $sku]);
        $uow->productos()->agregar($producto);
    }
    $producto->lotes()->create([
        'referencia' => $referencia,
        'sku' => $sku,
        'cantidad_comprada' => $cantidad,
        'eta' => $eta,
    ]);
    $uow->comprometer();
}

function asignarServicio(string $idPedido, string $sku, int $cantidad, UnidadDeTrabajo $uow): ?string
{
    $producto = $uow->productos()->obtener($sku);
    if ($producto === null) {
        throw new SkuInvalido("Sku inválido {$sku}");
    }
    $linea = LineaPedido::create(['id_pedido' => $idPedido, 'sku' => $sku, 'cantidad' => $cantidad]);
    $referencia = $producto->asignar($linea);
    $uow->comprometer();
    foreach ($producto->eventos as $evento) {
        manejar($evento); // publica al bus de mensajes
    }
    return $referencia;
}
