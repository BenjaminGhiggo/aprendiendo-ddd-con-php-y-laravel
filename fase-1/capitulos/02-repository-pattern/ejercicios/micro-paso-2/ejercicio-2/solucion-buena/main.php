<?php
// Ej2 — BUENA: las asignaciones en un array por clave; disponible se calcula sin duplicar.
final class Lote {
    private array $asignaciones = [];
    public function __construct(private int $comprado) {}
    public function asignar(string $clave, int $cantidad): void { $this->asignaciones[$clave] = $cantidad; }
    public function disponible(): int { return $this->comprado - array_sum($this->asignaciones); }
}
$lote = new Lote(20);
$lote->asignar("pedido-1|MESA|2", 2);
$lote->asignar("pedido-1|MESA|2", 2); // misma clave: no duplica
echo "disponible: " . $lote->disponible() . "\n"; // 18
