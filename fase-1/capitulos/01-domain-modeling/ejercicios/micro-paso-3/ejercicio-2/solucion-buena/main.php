<?php
// Ej2 — BUENA: puedeAsignar exige sku igual Y cantidad suficiente.
final class Lote {
    public function __construct(public string $sku, public int $disponible) {}
    public function puedeAsignar(string $sku, int $cantidad): bool { return $this->sku === $sku && $this->disponible >= $cantidad; }
}
$lote = new Lote("MESA", 100);
echo var_export($lote->puedeAsignar("TOSTADORA", 10), true) . "\n"; // false
echo var_export($lote->puedeAsignar("MESA", 10), true) . "\n";      // true
