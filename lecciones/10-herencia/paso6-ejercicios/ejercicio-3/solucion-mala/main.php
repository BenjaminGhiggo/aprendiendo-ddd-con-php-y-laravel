<?php
// Ej3 — MALA: para saber el tipo se compara un campo de texto (frágil).
class Lote { public function __construct(public string $ref, public string $tipo = "normal") {} }
$l = new Lote("l2", "refrigerado");
if ($l->tipo === "refrigerado") { echo "es refrigerado\n"; }  // y si alguien escribe mal el texto?
