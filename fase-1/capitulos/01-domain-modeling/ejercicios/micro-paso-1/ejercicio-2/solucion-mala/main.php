<?php
// Ej2 — MALA: nombres técnicos sin relación con el negocio.
class Cosa { public function __construct(public string $a, public int $b) {} }
$x = new Cosa("MESA", 2);
echo $x->a . " " . $x->b . "\n";
