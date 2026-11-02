<?php
// Ej3 — BUENA: el método asignar() protege la invariante; es imposible quedar en negativo.
class Lote {
    public function __construct(private int $disponible = 10) {}
    public function disponible(): int { return $this->disponible; }
    public function asignar(int $n): void {
        if ($n > $this->disponible) { throw new \DomainException("sin stock"); }
        $this->disponible -= $n;
    }
}
$l = new Lote();
try { $l->asignar(999); } catch (\DomainException $e) { echo "bloqueado: " . $e->getMessage() . "\n"; }
echo $l->disponible() . "\n";
