<?php
// nivel-intermedio.php — 🟡 5–8 (Lección 14 · OCP).
// P5: impuesto por país como registro + Chile sin tocar impuesto().
$tasas = ["Perú" => 0.18, "México" => 0.16];
function impuesto(array $tasas, string $pais, float $monto): float { return $monto * $tasas[$pais]; }
$tasas["Chile"] = 0.19;
echo "P5: " . impuesto($tasas, "Perú", 100) . " " . impuesto($tasas, "México", 100) . " " . impuesto($tasas, "Chile", 100) . "\n";
// P6: Triangulo sin tocar areaTotal.
abstract class Figura { abstract public function area(): float; }
class Rectangulo extends Figura { public function __construct(private float $a, private float $b) {} public function area(): float { return $this->a * $this->b; } }
class Cuadrado extends Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
class Triangulo extends Figura { public function __construct(private float $base, private float $altura) {} public function area(): float { return $this->base * $this->altura / 2; } }
function areaTotal(array $figuras): float { $t = 0; foreach ($figuras as $f) { $t += $f->area(); } return $t; }
echo "P6: " . areaTotal([new Rectangulo(2, 3), new Cuadrado(4), new Triangulo(6, 2)]) . "\n"; // 28
// P7: validaciones + sinEspacios.
$validaciones = [fn(string $t) => $t !== "", fn(string $t) => strlen($t) <= 10];
$validaciones[] = fn(string $t) => !str_contains($t, " ");
function esValido(array $vs, string $t): bool { foreach ($vs as $v) { if (!$v($t)) { return false; } } return true; }
echo "P7: " . var_export(esValido($validaciones, "ana"), true) . " " . var_export(esValido($validaciones, "ana lopez"), true) . "\n";
// P8: el error de pasar el RESULTADO en vez de la función.
echo "P8: TypeError (float no es callable); corregido: precioFinal(100, fn...) -> 90\n";
