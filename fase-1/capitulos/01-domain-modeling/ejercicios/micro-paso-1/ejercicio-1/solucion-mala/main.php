<?php
// Ej1 — MALA: la LineaPedido es mutable; cambiarle la cantidad la convierte en otra cosa.
class LineaPedido { public function __construct(public string $sku, public int $cantidad) {} }
$linea = new LineaPedido("MESA", 2);
$linea->cantidad = 999; // nada lo impide
echo $linea->cantidad . "\n";
