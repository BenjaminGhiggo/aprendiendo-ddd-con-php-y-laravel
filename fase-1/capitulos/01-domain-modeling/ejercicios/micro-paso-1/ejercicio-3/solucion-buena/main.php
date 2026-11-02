<?php
// Ej3 — BUENA: 'disponible' se CALCULA: comprado menos asignado.
final class Lote {
    private int $asignado = 0;
    public function __construct(public string $ref, private int $comprado) {}
    public function asignar(int $cantidad): void { $this->asignado += $cantidad; }
    public function disponible(): int { return $this->comprado - $this->asignado; }
}
$lote = new Lote("lote-001", 20);
$lote->asignar(2);
echo $lote->disponible() . "\n"; // 18
