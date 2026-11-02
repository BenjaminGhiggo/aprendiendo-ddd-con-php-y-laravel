<?php
// Ej2 — MALA: se instancia la clase "base" directamente; no tiene sentido (es un molde incompleto).
class Figura { public function area(): float { return 0.0; } } // un área 0 sin sentido
$f = new Figura();
echo $f->area() . "\n";   // 0: una figura abstracta no debería poder existir
