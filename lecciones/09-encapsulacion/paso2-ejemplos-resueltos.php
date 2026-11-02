<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 09 (los 4 ejemplos del README §9).
// Ejecuta: php lecciones/09-encapsulacion/paso2-ejemplos-resueltos.php
declare(strict_types=1);

echo "--- Ejemplo 1: proteger un dato con private (fácil) ---\n";
class Termostato {
    private int $grados;                       // Paso 1: dato PRIVADO
    public function __construct(int $grados) { $this->grados = $grados; }
    public function grados(): int { return $this->grados; }   // Paso 2: getter de lectura
}
$t = new Termostato(21);
echo $t->grados() . "\n";                       // 21 (no se puede escribir $t->grados = 999)

echo "\n--- Ejemplo 2: validar en el constructor (fácil) ---\n";
class Edad {
    public function __construct(private int $valor) {
        if ($valor < 0) { throw new \InvalidArgumentException("Edad negativa"); } // Paso 1: validar
    }
    public function valor(): int { return $this->valor; }
}
echo (new Edad(30))->valor() . "\n";            // 30
try { new Edad(-1); } catch (\InvalidArgumentException $e) { echo "rechazada: " . $e->getMessage() . "\n"; }

echo "\n--- Ejemplo 3: proteger una invariante (intermedio) ---\n";
class Cuenta {
    public function __construct(private int $saldo = 0) {}
    public function saldo(): int { return $this->saldo; }
    public function retirar(int $n): void {     // Paso 1: el método cuida la regla
        if ($n > $this->saldo) { throw new \DomainException("Saldo insuficiente"); }
        $this->saldo -= $n;
    }
}
$cuenta = new Cuenta(100);
$cuenta->retirar(30);
echo $cuenta->saldo() . "\n";                   // 70

echo "\n--- Ejemplo 4: propiedad calculada, como en el libro (avanzado) ---\n";
class LoteAsign {
    public function __construct(private int $comprada, private int $asignada = 0) {}
    // disponible NO se guarda: se CALCULA (como available_quantity del libro, Cap. 1).
    public function disponible(): int { return $this->comprada - $this->asignada; }
    public function asignar(int $n): void { $this->asignada += $n; }
}
$lote = new LoteAsign(20);
$lote->asignar(2);
echo $lote->disponible() . "\n";                // 18
