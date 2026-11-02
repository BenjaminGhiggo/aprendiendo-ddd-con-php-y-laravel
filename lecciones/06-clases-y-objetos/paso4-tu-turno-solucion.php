<?php
declare(strict_types=1);
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.
class Lote {
    public int $asignado = 0;
    public function __construct(
        public string $referencia,
        public string $sku,
        public int $comprado,
    ) {}
    public function disponible(): int { return $this->comprado - $this->asignado; }
    public function asignar(int $cantidad): void { $this->asignado += $cantidad; }
}

$lote = new Lote("lote-001", "MESA", 20);
echo $lote->disponible() . "\n";   // 20
$lote->asignar(2);
echo $lote->disponible() . "\n";   // 18
$lote->asignar(3);
echo $lote->disponible() . "\n";   // 15
