<?php
// Ej2 — MALA: la entidad compara TODOS sus datos; deja de ser "la misma" al cambiar el stock.
final class Lote {
    public function __construct(public string $ref, public int $stock) {}
    public function equals(Lote $o): bool { return $this->ref === $o->ref && $this->stock === $o->stock; }
}
$antes = new Lote("lote-001", 20);
$despues = new Lote("lote-001", 18);
echo var_export($antes->equals($despues), true) . "\n"; // false (¡pero es el mismo lote!)
