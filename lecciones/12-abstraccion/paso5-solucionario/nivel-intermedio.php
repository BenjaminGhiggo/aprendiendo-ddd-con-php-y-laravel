<?php
declare(strict_types=1);
// nivel-intermedio.php — 🟡 5–8.
abstract class Figura {
    abstract public function area(): float;
    public function describir(): string { return "área = " . $this->area(); } // código compartido
}
class Rectangulo extends Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } }
class Triangulo extends Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return ($this->b * $this->h) / 2; } }
echo "P5: " . (new Rectangulo(2, 3))->area() . "\n";           // 6
echo "P6: " . (new Triangulo(4, 3))->area() . "\n";            // 6
echo "P7: " . (new Rectangulo(2, 3))->describir() . "\n";      // área = 6 (método heredado)
$figuras = [new Rectangulo(2, 3), new Triangulo(4, 3)];
$total = 0.0; foreach ($figuras as $f) { $total += $f->area(); }
echo "P8: " . $total . "\n";                                   // 12
