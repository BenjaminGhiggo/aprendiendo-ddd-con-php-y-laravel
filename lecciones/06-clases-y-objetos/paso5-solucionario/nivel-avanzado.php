<?php
declare(strict_types=1);
// nivel-avanzado.php — problemas 🔴 9–12 (README §10): el Lote del libro.
class Lote {
    public int $asignado = 0;
    public function __construct(public string $referencia, public string $sku, public int $comprado) {}
    public function disponible(): int { return $this->comprado - $this->asignado; }
    public function puedeAsignar(string $sku, int $cantidad): bool {
        return $this->sku === $sku && $this->disponible() >= $cantidad;
    }
    public function asignar(int $cantidad): void { if ($this->puedeAsignar($this->sku, $cantidad)) { $this->asignado += $cantidad; } }
}
$lote = new Lote("lote-001", "MESA", 20);
echo "P9: disponible " . $lote->disponible() . "\n";                      // 20
echo "P10: puedeAsignar MESA 30? " . var_export($lote->puedeAsignar("MESA", 30), true) . "\n"; // false
echo "P11: puedeAsignar SILLA 5? " . var_export($lote->puedeAsignar("SILLA", 5), true) . "\n"; // false
$lote->asignar(5);
echo "P12: tras asignar 5, disponible " . $lote->disponible() . "\n";     // 15
