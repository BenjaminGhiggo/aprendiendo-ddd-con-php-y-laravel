<?php
// Ej2 — MALA: puedeAsignar solo mira la cantidad; ignora que el sku debe coincidir.
final class Lote {
    public function __construct(public string $sku, public int $disponible) {}
    public function puedeAsignar(string $sku, int $cantidad): bool { return $this->disponible >= $cantidad; }
}
$lote = new Lote("MESA", 100);
echo var_export($lote->puedeAsignar("TOSTADORA", 10), true) . "\n"; // true (¡pero el sku no coincide!)
