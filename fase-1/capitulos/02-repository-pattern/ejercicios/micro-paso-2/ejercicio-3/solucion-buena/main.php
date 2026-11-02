<?php
// Ej3 — BUENA: una entidad compara por identidad (la referencia) con equals().
final class Lote {
    public function __construct(public string $ref, public int $stock) {}
    public function equals(Lote $o): bool { return $o->ref === $this->ref; }
}
$a = new Lote("lote-1", 20);
$b = new Lote("lote-1", 18);
echo var_export($a->equals($b), true) . "\n"; // true
