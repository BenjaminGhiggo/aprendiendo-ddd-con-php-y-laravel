<?php
// paso1-formulas.php — PASO 1 de la Lección 11 (Polimorfismo).
// Ejecuta: php lecciones/11-polimorfismo/paso1-formulas.php
declare(strict_types=1);

// PO1 · interface: un CONTRATO. Dice QUÉ métodos debe tener algo, sin decir CÓMO.
interface Figura {
    public function area(): float;
}

// PO2 · implements: una clase que cumple el contrato (promete tener area()).
class Cuadrado implements Figura {
    public function __construct(private float $lado) {}
    public function area(): float { return $this->lado * $this->lado; }
}
class Circulo implements Figura {
    public function __construct(private float $radio) {}
    public function area(): float { return 3.14 * $this->radio * $this->radio; }
}

$cuadrado = new Cuadrado(4);
$circulo = new Circulo(2);
echo "PO2 area cuadrado: " . $cuadrado->area() . "\n";   // 16
echo "PO2 area círculo:  " . $circulo->area() . "\n";    // 12.56

// PO3 · tipar por la INTERFAZ: una función acepta CUALQUIER Figura.
function describir(Figura $f): string {
    return "área = " . $f->area();     // no sabe si es cuadrado o círculo: solo que es Figura
}
echo "PO3 describir(cuadrado): " . describir($cuadrado) . "\n";

// PO4 · un array de Figuras (distintas clases, mismo contrato).
$figuras = [new Cuadrado(1), new Circulo(1), new Cuadrado(3)];
// PO5 · recorrer y llamar el MISMO método en todas, sin un if por tipo.
echo "PO5 recorrer:\n";
foreach ($figuras as $figura) {
    echo "      área = " . $figura->area() . "\n";
}

// PO6 · sumar áreas: el mismo código sirve para cualquier Figura futura (¡el rectángulo!).
function areaTotal(array $figuras): float {
    $total = 0.0;
    foreach ($figuras as $figura) { $total += $figura->area(); }
    return $total;
}
echo "PO6 areaTotal: " . areaTotal($figuras) . "\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (§8):
// - Pasar algo que NO implementa Figura a describir() -> TypeError.
// - A diferencia de Python (duck typing), PHP exige "implements Figura" explícito.
// ---------------------------------------------------------------------------
