<?php
declare(strict_types=1);
// MALA: el test construye el objeto; si el constructor cambia de orden/firma, el test se rompe.
final class LineaPedido {
    // imagina que ayer era (sku, cantidad) y hoy es (idPedido, sku, cantidad): este test ya no compila igual
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(LineaPedido $l): string { return "lote-1"; }
// Habia que reescribir TODOS los tests que hacian new LineaPedido(...)
echo servicioAsignar(new LineaPedido("o1", "LAMPARA", 10)) . "\n";
