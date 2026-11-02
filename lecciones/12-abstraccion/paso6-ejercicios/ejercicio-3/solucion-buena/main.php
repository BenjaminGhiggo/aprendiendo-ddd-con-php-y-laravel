<?php
// Ej3 — BUENA: la abstracta trae describir() UNA vez; las hijas solo implementan area().
abstract class Figura {
    abstract public function area(): float;
    public function describir(): string { return "área = " . $this->area(); } // compartido
}
class Rectangulo extends Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } }
class Triangulo extends Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return ($this->b * $this->h) / 2; } }
echo (new Rectangulo(2, 3))->describir() . "\n";
