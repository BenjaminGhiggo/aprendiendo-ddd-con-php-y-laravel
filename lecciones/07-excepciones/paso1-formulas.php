<?php
declare(strict_types=1);
// paso1-formulas.php — PASO 1 de la Lección 07.
// Ejecuta:  php lecciones/07-excepciones/paso1-formulas.php

echo "========== LANZAR Y ATRAPAR ==========\n";

// X1 · Lanzar un error con 'throw new Exception(mensaje)'.
// X2 · Atraparlo con try / catch para que el programa NO se caiga.
function dividir(int $a, int $b): int {
    if ($b === 0) {
        throw new \InvalidArgumentException("no se puede dividir entre cero");
    }
    return intdiv($a, $b);
}
try {
    echo "X1/X2 10/2 = " . dividir(10, 2) . "\n";
    echo "X1/X2 10/0 = " . dividir(10, 0) . "\n"; // lanza
} catch (\InvalidArgumentException $e) {
    echo "  atrapado: " . $e->getMessage() . "\n"; // X3: leer el mensaje
}

echo "\n========== EXCEPCIÓN PROPIA (del negocio) ==========\n";

// X4 · Crear TU error con nombre del negocio: una clase que extiende Exception.
class SinStock extends \Exception {}

function asignar(int $cantidad, int $disponible): int {
    if ($cantidad > $disponible) {
        throw new SinStock("sin stock: piden $cantidad y hay $disponible");
    }
    return $disponible - $cantidad;
}
try {
    echo "X4 asignar 2 de 20: queda " . asignar(2, 20) . "\n";
    echo "X4 asignar 99 de 20...\n";
    asignar(99, 20); // lanza SinStock
} catch (SinStock $e) {
    echo "  SinStock: " . $e->getMessage() . "\n";
}

echo "\n========== VARIOS CATCH, FINALLY ==========\n";

// X5 · Varios catch: PHP usa el primero que coincida por tipo.
// X6 · finally: SIEMPRE corre, haya error o no (p. ej. para limpiar).
function procesar(string $entrada): void {
    try {
        if ($entrada === "") {
            throw new \InvalidArgumentException("vacío");
        }
        if ($entrada === "boom") {
            throw new \RuntimeException("explotó");
        }
        echo "  procesado: $entrada\n";
    } catch (\InvalidArgumentException $e) {
        echo "  error de argumento: " . $e->getMessage() . "\n";
    } catch (\RuntimeException $e) {
        echo "  error en ejecución: " . $e->getMessage() . "\n";
    } finally {
        echo "  (finally: siempre corre)\n";
    }
}
procesar("hola");
procesar("");
procesar("boom");

echo "\n========== EL ERROR SUBE (se propaga) ==========\n";

// X7 · Si una función no atrapa el error, SUBE a quien la llamó.
function nivelBajo(): void { throw new SinStock("desde el fondo"); }
function nivelAlto(): void { nivelBajo(); } // no atrapa: el error pasa de largo
try {
    nivelAlto();
} catch (SinStock $e) {
    echo "X7 atrapado arriba: " . $e->getMessage() . "\n";
}

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8). Descomenta UNA línea para ver qué pasa SIN atraparlo.
// throw new SinStock("nadie me atrapa");  // E1 -> Fatal error: Uncaught SinStock: nadie me atrapa
// echo intdiv(1, 0);                       // E2 -> DivisionByZeroError: Division by zero
// ---------------------------------------------------------------------------
