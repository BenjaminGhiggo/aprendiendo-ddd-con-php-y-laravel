<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 10 (los 4 ejemplos del README §9).
declare(strict_types=1);

echo "--- Ejemplo 1: una hija hereda todo (fácil) ---\n";
class Animal { public function __construct(protected string $nombre) {} public function nombre(): string { return $this->nombre; } }
class Perro extends Animal {}                       // hereda nombre() sin escribir nada
echo (new Perro("Fido"))->nombre() . "\n";          // Fido

echo "\n--- Ejemplo 2: parent::__construct (fácil) ---\n";
class Empleado {
    public function __construct(protected int $salarioBase) {}
    public function salario(): int { return $this->salarioBase; }
}
class Gerente extends Empleado {
    public function __construct(int $salarioBase, private int $bono) {
        parent::__construct($salarioBase);          // Paso 1: inicializa lo de la madre
    }
    public function salario(): int { return parent::salario() + $this->bono; } // Paso 2: extiende
}
echo (new Gerente(1000, 500))->salario() . "\n";    // 1500

echo "\n--- Ejemplo 3: sobrescribir con parent:: (intermedio) ---\n";
class Saludo { public function texto(): string { return "Hola"; } }
class SaludoFormal extends Saludo {
    public function texto(): string { return parent::texto() . ", estimado cliente"; }
}
echo (new SaludoFormal())->texto() . "\n";          // Hola, estimado cliente

echo "\n--- Ejemplo 4: instanceof para distinguir tipos (avanzado) ---\n";
class Lote { public function __construct(public string $ref) {} }
class LoteRefrigerado extends Lote {}
$lotes = [new Lote("l1"), new LoteRefrigerado("l2")];
foreach ($lotes as $lote) {
    $tipo = $lote instanceof LoteRefrigerado ? "refrigerado" : "normal";
    echo "{$lote->ref}: $tipo\n";
}
