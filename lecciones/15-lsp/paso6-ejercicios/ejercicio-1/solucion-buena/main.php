<?php
// BUENA: Cuadrado y Rectangulo son HERMANOS (heredan de Figura), no padre-hijo.
abstract class Figura { abstract public function area(): int; }
class Rectangulo extends Figura { public function __construct(private int $a, private int $b) {} public function area(): int { return $this->a * $this->b; } }
class Cuadrado extends Figura { public function __construct(private int $l) {} public function area(): int { return $this->l * $this->l; } }
echo (new Cuadrado(5))->area() . "\n";
