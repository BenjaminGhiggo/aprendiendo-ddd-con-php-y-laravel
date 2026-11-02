<?php
// Ej1 — MALA: comparar value objects con === compara IDENTIDAD de instancia: da false.
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$a = new LineaPedido("MESA", 2);
$b = new LineaPedido("MESA", 2);
echo var_export($a === $b, true) . "\n"; // false
