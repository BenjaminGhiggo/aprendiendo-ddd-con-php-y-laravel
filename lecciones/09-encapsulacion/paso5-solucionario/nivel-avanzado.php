<?php
// nivel-avanzado.php — soluciones 🔴 9–12 (README §10).
declare(strict_types=1);
// P9: Lote con disponible calculado y asignaciones protegidas.
class Lote {
    private array $asignaciones = [];
    public function __construct(private int $comprada) {}
    public function disponible(): int { $s = 0; foreach ($this->asignaciones as $n) { $s += $n; } return $this->comprada - $s; }
    public function asignar(int $n): void { if ($n > $this->disponible()) throw new \DomainException("sin stock"); $this->asignaciones[] = $n; }
}
$lote = new Lote(20);
$lote->asignar(2); $lote->asignar(3);
echo "P9: " . $lote->disponible() . "\n";                          // 15
// P10: no se puede dejar en negativo.
try { (new Lote(5))->asignar(10); } catch (\DomainException $e) { echo "P10: " . $e->getMessage() . "\n"; } // sin stock
// P11: readonly protege la identidad.
class Entidad { public function __construct(public readonly string $ref) {} }
echo "P11: " . (new Entidad("lote-001"))->ref . "\n";              // lote-001
// P12 (puente al libro): available_quantity como propiedad calculada (Cap. 1).
class LoteLibro {
    public function __construct(private int $purchasedQuantity, private int $allocatedQuantity = 0) {}
    public function availableQuantity(): int { return $this->purchasedQuantity - $this->allocatedQuantity; }
}
echo "P12: " . (new LoteLibro(20, 2))->availableQuantity() . "\n"; // 18
