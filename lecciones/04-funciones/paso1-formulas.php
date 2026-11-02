<?php
declare(strict_types=1);
// paso1-formulas.php — PASO 1 de la Lección 04.
// Cada bloque es una "fórmula" de las tablas del README (§5 y §6), con su código (F1, G1...).
// Ejecuta:  php lecciones/04-funciones/paso1-formulas.php

echo "========== FUNCIONES ==========\n";

// F1 · Definir una función: 'function', nombre, (), y su cuerpo entre llaves.
function saludar(): string {
    return "hola";
}
// F2 · Llamarla por su nombre con ().
echo "F1/F2 llamar:         " . saludar() . "\n";

// F3 · Con un parámetro tipado y tipo de retorno (: int).
function doble(int $n): int {
    return $n * 2;
}
echo "F3  doble(5):         " . doble(5) . "\n";

// F4 · Varios parámetros.
function sumar(int $a, int $b): int {
    return $a + $b;
}
echo "F4  sumar(2, 3):      " . sumar(2, 3) . "\n";

// F5 · Parámetro con valor por defecto (si no lo pasas, usa el default).
function saludarA(string $nombre = "mundo"): string {
    return "hola, $nombre";
}
echo "F5  sin argumento:    " . saludarA() . "\n";
echo "F5  con argumento:    " . saludarA("Ana") . "\n";

// F6 · Parámetro OPCIONAL que puede ser null (?int = int o null).
function precio(?int $descuento): int {
    return 100 - ($descuento ?? 0);
}
echo "F6  precio(null):     " . precio(null) . "\n";
echo "F6  precio(20):       " . precio(20) . "\n";

// F7 · 'void': una función que NO devuelve nada (solo hace algo).
function avisar(string $m): void {
    echo "  AVISO: $m\n";
}
echo "F7  void:\n";
avisar("hola");

// F8 · Argumentos con NOMBRE (PHP 8): pasas por el nombre del parámetro.
echo "F8  nombrados:        " . saludarA(nombre: "Beto") . "\n";

echo "\n========== FUNCIONES FLECHA Y CLOSURES ==========\n";

// G1 · Función flecha: fn(params) => expresión. Para funciones de una sola línea.
$triple = fn(int $n): int => $n * 3;
echo "G1  fn triple(4):     " . $triple(4) . "\n";

// G2 · Closure clásica: function() { ... }. Guardada en una variable.
$cuadrado = function (int $n): int {
    return $n * $n;
};
echo "G2  closure(5):       " . $cuadrado(5) . "\n";

// G3 · Una función que recibe OTRA función (callable) y la usa.
function aplicar(int $valor, callable $f): int {
    return $f($valor);
}
echo "G3  aplicar(10, …):   " . aplicar(10, $triple) . "\n";

// G4 · 'use' captura una variable de afuera dentro de la closure.
$factor = 7;
$multiplicar = function (int $n) use ($factor): int {
    return $n * $factor;
};
echo "G4  use(\$factor=7):   " . $multiplicar(2) . "\n";

// G5 · Un array de funciones (como HANDLERS del libro; se estudia en la 05).
$operaciones = [$triple, $cuadrado];
echo "G5  array de fn:      ";
foreach ($operaciones as $op) {
    echo $op(2) . " ";
}
echo "\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8). Descomenta UNA línea, ejecuta y lee el mensaje real.
// echo sumar(2);           // E1 -> ArgumentCountError: Too few arguments to function sumar(), 1 passed ... exactly 2 expected
// echo doble("hola");      // E2 -> TypeError: doble(): Argument #1 ($n) must be of type int, string given
// echo saludarr();         // E3 -> Error: Call to undefined function saludarr()
// echo $resultado;         // E5 -> Warning: Undefined variable $resultado
// ---------------------------------------------------------------------------
