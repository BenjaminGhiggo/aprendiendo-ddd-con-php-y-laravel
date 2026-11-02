<?php
// Ej3 — BUENA: instanceof distingue el tipo real por la clase (seguro).
class Lote { public function __construct(public string $ref) {} }
class LoteRefrigerado extends Lote {}
$l = new LoteRefrigerado("l2");
if ($l instanceof LoteRefrigerado) { echo "es refrigerado\n"; }
