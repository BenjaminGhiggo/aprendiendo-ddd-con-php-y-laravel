<?php
// Ej2 — BUENA: una entidad compara solo su IDENTIDAD (la referencia).
final class Lote {
    public function __construct(public string $ref, public int $stock) {}
    public function equals(Lote $o): bool { return $o->ref === $this->ref; }
}
$antes = new Lote("lote-001", 20);
$despues = new Lote("lote-001", 18);
echo var_export($antes->equals($despues), true) . "\n"; // true: sigue siendo el mismo lote
