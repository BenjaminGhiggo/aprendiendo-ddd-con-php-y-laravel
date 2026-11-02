<?php
// Ej3 — MALA: el "disponible" es un dato suelto que hay que recordar actualizar a mano.
class Lote { public int $disponible; public function __construct(public string $ref, int $cantidad) { $this->disponible = $cantidad; } }
$lote = new Lote("lote-001", 20);
// si asignamos 2 pero olvidamos restar, 'disponible' miente:
echo $lote->disponible . "\n"; // 20
