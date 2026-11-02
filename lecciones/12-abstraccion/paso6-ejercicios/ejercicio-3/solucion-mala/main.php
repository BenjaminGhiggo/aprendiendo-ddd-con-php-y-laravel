<?php
// Ej3 — MALA: repetir el método describir() en cada hija (código duplicado).
class Rectangulo { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } public function describir(): string { return "área = " . $this->area(); } }
class Triangulo { public function __construct(private float $b, private float $h) {} public function area(): float { return ($this->b * $this->h) / 2; } public function describir(): string { return "área = " . $this->area(); } }
echo (new Rectangulo(2, 3))->describir() . "\n";
