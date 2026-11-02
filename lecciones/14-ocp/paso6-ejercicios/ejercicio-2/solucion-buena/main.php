<?php
// BUENA: polimorfismo; una figura nueva es una clase nueva (OCP).
abstract class Figura { abstract public function area(): float; }
class Rectangulo extends Figura { public function __construct(private float $a, private float $b) {} public function area(): float { return $this->a * $this->b; } }
class Cuadrado extends Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
echo (new Cuadrado(4))->area() . "\n";
