<?php
// Ej1 — BUENA: un value object define su propio equals() por VALOR.
final class LineaPedido {
    public function __construct(public readonly string $sku, public readonly int $cantidad) {}
    public function equals(LineaPedido $o): bool { return $this->sku === $o->sku && $this->cantidad === $o->cantidad; }
}
$a = new LineaPedido("MESA", 2);
$b = new LineaPedido("MESA", 2);
echo var_export($a->equals($b), true) . "\n"; // true
