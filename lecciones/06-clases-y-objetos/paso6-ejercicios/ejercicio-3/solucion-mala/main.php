<?php
declare(strict_types=1);
// Ej3 — MALA: 'disponible' es un dato suelto que hay que recordar actualizar a mano.
class Lote {
    public int $disponible;
    public function __construct(public int $comprado) { $this->disponible = $comprado; }
}
$lote = new Lote(20);
// si asignamos 2 pero olvidamos restar, 'disponible' miente:
echo $lote->disponible . "\n"; // 20, aunque "ya asignamos"
