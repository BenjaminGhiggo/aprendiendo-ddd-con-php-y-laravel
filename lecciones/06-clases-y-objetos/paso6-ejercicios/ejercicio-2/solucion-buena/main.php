<?php
declare(strict_types=1);
// Ej2 — BUENA: la regla es un MÉTODO del objeto; el lote sabe responder por sí mismo.
class Lote {
    public function __construct(public string $sku, public int $disponible) {}
    public function puedeAsignar(string $sku, int $cantidad): bool {
        return $this->sku === $sku && $this->disponible >= $cantidad;
    }
}
$lote = new Lote("MESA", 20);
echo var_export($lote->puedeAsignar("MESA", 5), true) . "\n";
