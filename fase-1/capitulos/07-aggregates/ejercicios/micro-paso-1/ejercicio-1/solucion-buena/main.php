<?php
// Ej1-BUENA: se asigna a TRAVES del agregado, que sube su numero de version en cada cambio.
final class Producto {
    public int $numeroVersion = 0;
    public function __construct(public int $disponible) {}
    public function asignar(int $cantidad): void { $this->disponible -= $cantidad; $this->numeroVersion++; }
}
$p = new Producto(100);
$p->asignar(10);
echo "disponible={$p->disponible} version={$p->numeroVersion}\n"; // version=1
