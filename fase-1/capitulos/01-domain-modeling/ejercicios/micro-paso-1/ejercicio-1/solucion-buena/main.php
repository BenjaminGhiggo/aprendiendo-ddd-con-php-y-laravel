<?php
// Ej1 — BUENA: propiedades readonly; un value object es inmutable (como frozen en Python).
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$linea = new LineaPedido("MESA", 2);
// $linea->cantidad = 999;  // Error: Cannot modify readonly property LineaPedido::$cantidad
echo $linea->cantidad . "\n";
