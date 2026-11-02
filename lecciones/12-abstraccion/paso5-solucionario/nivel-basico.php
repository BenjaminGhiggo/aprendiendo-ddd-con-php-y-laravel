<?php
declare(strict_types=1);
// nivel-basico.php — 🟢 1–4.
abstract class Forma { abstract public function area(): float; }
class Cuadrado extends Forma { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
echo "P1: " . (new Cuadrado(4))->area() . "\n";                // 16
interface Saludo { public function texto(): string; }
class Es implements Saludo { public function texto(): string { return "hola"; } }
echo "P2: " . (new Es())->texto() . "\n";                      // hola
echo "P3: " . var_export((new Cuadrado(2)) instanceof Forma, true) . "\n";  // true
echo "P4: " . var_export((new Es()) instanceof Saludo, true) . "\n";        // true
