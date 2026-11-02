<?php

declare(strict_types=1);

require_once __DIR__ . '/unidad-de-trabajo.php';

// servicios.php — la capa de servicios ahora recibe una UoW (no repo+sesión sueltos).
final class SkuInvalido extends \Exception {}

/** @param Lote[] $lotes */
function skuValido(string $sku, array $lotes): bool
{
    foreach ($lotes as $lote) {
        if ($lote->sku === $sku) {
            return true;
        }
    }
    return false;
}

function agregarLote(string $referencia, string $sku, int $cantidad, ?string $eta, UnidadDeTrabajo $uow): void
{
    $uow->ejecutar(function () use ($referencia, $sku, $cantidad, $eta, $uow) {
        $uow->lotes->agregar(new Lote([
            'referencia' => $referencia, 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta,
        ]));
        $uow->comprometer();
    });
}

function asignarServicio(string $idPedido, string $sku, int $cantidad, UnidadDeTrabajo $uow): string
{
    $linea = new LineaPedido($idPedido, $sku, $cantidad);
    return $uow->ejecutar(function () use ($linea, $uow): string {
        $lotes = $uow->lotes->listar();
        if (!skuValido($linea->sku, $lotes)) {
            throw new SkuInvalido("Sku inválido {$linea->sku}");
        }
        $referencia = asignar($linea, $lotes);
        $uow->comprometer();
        return $referencia;
    });
}
