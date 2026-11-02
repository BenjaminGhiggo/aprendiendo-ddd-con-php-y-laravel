<?php
// Ej1 — MALA: resta a mano; asignar la misma línea dos veces descuenta doble.
final class Lote {
    public int $disponible;
    public function __construct(int $cantidad) { $this->disponible = $cantidad; }
    public function asignar(int $c): void { $this->disponible -= $c; }
}
$lote = new Lote(20);
$lote->asignar(2);
$lote->asignar(2); // la MISMA línea otra vez
echo $lote->disponible . "\n"; // 16 (¡debería ser 18!)
