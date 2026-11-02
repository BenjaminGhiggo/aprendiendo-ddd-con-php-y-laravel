<?php

declare(strict_types=1);

require_once __DIR__ . '/unidad-de-trabajo.php';

// servicios.php — la capa de servicios trabaja ahora contra el agregado `Producto`: obtiene el
// producto por sku y le pide asignar. Ya no ordena lotes ni valida stock a mano (eso vive en el
// agregado). El servicio solo orquesta: obtener → asignar → comprometer.
final class SkuInvalido extends \Exception {}

function agregarLote(string $referencia, string $sku, int $cantidad, ?string $eta, UnidadDeTrabajo $uow): void
{
    $uow->ejecutar(function () use ($referencia, $sku, $cantidad, $eta, $uow) {
        $producto = $uow->productos->obtener($sku) ?? Producto::crear($sku, []);
        $producto->agregarLote(new Lote([
            'referencia' => $referencia, 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta,
        ]));
        $uow->productos->agregar($producto);
        $uow->comprometer();
    });
}

function asignarServicio(string $idPedido, string $sku, int $cantidad, UnidadDeTrabajo $uow): string
{
    $linea = new LineaPedido($idPedido, $sku, $cantidad);
    return $uow->ejecutar(function () use ($linea, $sku, $uow): string {
        $producto = $uow->productos->obtener($sku);
        if ($producto === null) {
            throw new SkuInvalido("Sku inválido {$sku}");
        }
        $referencia = $producto->asignar($linea);
        $uow->productos->agregar($producto);   // persiste el nuevo numero_version del agregado
        $uow->comprometer();
        return $referencia;
    });
}
