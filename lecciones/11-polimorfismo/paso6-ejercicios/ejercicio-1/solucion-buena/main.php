<?php
// Ej1 — BUENA: cada figura sabe calcular su área; el código que las usa no cambia.
interface Figura { public function area(): float; }
class Cuadrado implements Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
class Circulo implements Figura { public function __construct(private float $r) {} public function area(): float { return 3.14 * $this->r * $this->r; } }
function mostrar(Figura $f): void { echo $f->area() . "\n"; }
mostrar(new Cuadrado(4));
