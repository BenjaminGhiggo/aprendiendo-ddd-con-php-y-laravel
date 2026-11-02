<?php
// MALA: Cuadrado hereda de Rectangulo y rompe su invariante (ancho == alto).
class Rectangulo { public int $ancho = 0; public int $alto = 0; public function area(): int { return $this->ancho * $this->alto; } }
class Cuadrado extends Rectangulo { public function setLado(int $l): void { $this->ancho = $l; $this->alto = $l; } }
$c = new Cuadrado(); $c->ancho = 5; $c->alto = 4; // ¡un "cuadrado" con lados distintos!
echo $c->area() . "\n";
