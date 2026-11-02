<?php
// Ej3 — MALA: desasignar suma a mano; si la línea no estaba, "devuelve" stock de más.
final class Lote {
    public int $disponible;
    public function __construct(int $cantidad) { $this->disponible = $cantidad; }
    public function desasignar(int $c): void { $this->disponible += $c; }
}
$lote = new Lote(20);
$lote->desasignar(2); // nunca estuvo asignada
echo $lote->disponible . "\n"; // 22 (¡apareció stock de la nada!)
