<?php
// Ej2 — BUENA: Figura es abstracta; no se puede instanciar, solo sus hijas concretas.
abstract class Figura { abstract public function area(): float; }
class Cuadrado extends Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
// new Figura();  // Error: Cannot instantiate abstract class Figura
echo (new Cuadrado(4))->area() . "\n";   // 16
