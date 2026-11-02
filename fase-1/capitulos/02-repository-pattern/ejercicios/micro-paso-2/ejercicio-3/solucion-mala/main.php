<?php
// Ej3 — MALA: comparar dos modelos del mismo lote con == puede fallar por datos de más (id, etc.).
final class Lote { public function __construct(public string $ref, public int $stock) {} }
$a = new Lote("lote-1", 20);
$b = new Lote("lote-1", 18); // mismo lote, ya asignó algo
echo var_export($a == $b, true) . "\n"; // false
