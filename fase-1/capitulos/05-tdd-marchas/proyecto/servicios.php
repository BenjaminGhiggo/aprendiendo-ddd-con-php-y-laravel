<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';

// servicios.php — la capa de servicios recibe PRIMITIVOS (string/int), no objetos de dominio.
// Así los tests de servicios quedan DESACOPLADOS del modelo (usan strings/ints), y pueden
// "subir de marcha": probar el caso de uso completo sin armar objetos de dominio a mano.

final class SkuInvalido extends \Exception {}

interface Sesion
{
    public function commit(): void;
}

final class SesionFalsa implements Sesion
{
    public bool $comprometida = false;

    public function commit(): void
    {
        $this->comprometida = true;
    }
}

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

// El servicio ARMA el lote desde primitivos (antes lo hacía quien lo llamaba).
function agregarLote(string $referencia, string $sku, int $cantidad, ?\DateTimeImmutable $eta, RepositorioDeLotes $repo, Sesion $sesion): void
{
    $repo->agregar(new Lote($referencia, $sku, $cantidad, $eta));
    $sesion->commit();
}

// El servicio recibe primitivos y ARMA la línea de pedido por dentro.
function servicioAsignar(string $idPedido, string $sku, int $cantidad, RepositorioDeLotes $repo, Sesion $sesion): string
{
    $linea = new LineaPedido($idPedido, $sku, $cantidad);
    $lotes = $repo->listar();
    if (!skuValido($linea->sku, $lotes)) {
        throw new SkuInvalido("Sku inválido {$linea->sku}");
    }
    $referencia = asignar($linea, $lotes);
    $sesion->commit();
    return $referencia;
}
