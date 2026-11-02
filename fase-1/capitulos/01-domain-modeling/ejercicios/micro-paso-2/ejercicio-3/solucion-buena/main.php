<?php
// Ej3 — BUENA: un array indexado por la clave del value object sí deduplica por valor.
final class LineaPedido {
    public function __construct(public readonly string $sku, public readonly int $cantidad) {}
    public function clave(): string { return "{$this->sku}|{$this->cantidad}"; }
}
$mapa = [];
$l1 = new LineaPedido("MESA", 2);
$l2 = new LineaPedido("MESA", 2);
$mapa[$l1->clave()] = $l1;
$mapa[$l2->clave()] = $l2; // misma clave: no duplica
echo count($mapa) . "\n"; // 1
