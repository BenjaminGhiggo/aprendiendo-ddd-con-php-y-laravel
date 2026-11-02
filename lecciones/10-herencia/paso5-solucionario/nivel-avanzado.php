<?php
declare(strict_types=1);
// nivel-avanzado.php — 🔴 9–12.
class Lote {
    public function __construct(protected string $referencia, protected int $cantidad) {}
    public function referencia(): string { return $this->referencia; }
    public function disponible(): int { return $this->cantidad; }
}
class LoteRefrigerado extends Lote {
    public function __construct(string $ref, int $cantidad, private int $temp) { parent::__construct($ref, $cantidad); }
    public function temperatura(): int { return $this->temp; }
}
$frio = new LoteRefrigerado("lote-002", 10, 4);
echo "P9: " . $frio->referencia() . "\n";                           // lote-002 (heredado)
echo "P10: " . $frio->temperatura() . "\n";                         // 4 (propio)
echo "P11: " . var_export($frio instanceof Lote, true) . "\n";      // true
// P12 (puente al libro): FakeRepository extends AbstractRepository (Cap. 2).
abstract class RepositorioAbstracto {
    abstract public function agregar(Lote $lote): void;
}
class RepositorioFalso extends RepositorioAbstracto {
    private array $lotes = [];
    public function agregar(Lote $lote): void { $this->lotes[] = $lote; }
    public function total(): int { return count($this->lotes); }
}
$repo = new RepositorioFalso();
$repo->agregar($frio);
echo "P12: " . $repo->total() . "\n";                               // 1
