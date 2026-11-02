<?php
declare(strict_types=1);
// Ej3 — BUENA: 'disponible' se CALCULA en un método; no puede quedar descuadrado.
class Lote {
    public int $asignado = 0;
    public function __construct(public int $comprado) {}
    public function asignar(int $cantidad): void { $this->asignado += $cantidad; }
    public function disponible(): int { return $this->comprado - $this->asignado; }
}
$lote = new Lote(20);
$lote->asignar(2);
echo $lote->disponible() . "\n"; // 18
