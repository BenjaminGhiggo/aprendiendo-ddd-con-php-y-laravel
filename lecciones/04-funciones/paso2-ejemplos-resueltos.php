<?php
declare(strict_types=1);
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 04. Los 4 ejemplos del README (§9).
// Ejecuta:  php lecciones/04-funciones/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: empaquetar una regla en una función (fácil) ---\n";
function areaRectangulo(int $base, int $altura): int { // Paso 1: definir con parámetros
    return $base * $altura;                             // Paso 2: devolver (no imprimir)
}
$area = areaRectangulo(4, 3);                           // Paso 3: llamar y GUARDAR el resultado
echo "área = $area\n";                                  // -> 12

echo "\n--- Ejemplo 2: imprimir NO es devolver (fácil) ---\n";
function sumaImprime(int $a, int $b): void { echo ($a + $b) . "\n"; } // imprime, devuelve null
function sumaDevuelve(int $a, int $b): int { return $a + $b; }        // devuelve un número
$r = sumaDevuelve(2, 3);
echo "puedo usar lo devuelto: " . ($r * 10) . "\n";    // 50
sumaImprime(2, 3);                                      // imprime 5, pero no puedo usarlo

echo "\n--- Ejemplo 3: valor por defecto (intermedio) ---\n";
function precioFinal(int $precio, int $descuento = 0): int { // descuento es opcional
    return $precio - $descuento;
}
echo "sin descuento: " . precioFinal(100) . "\n";       // 100
echo "con descuento: " . precioFinal(100, 20) . "\n";   // 80

echo "\n--- Ejemplo 4: una función que recibe otra función (avanzado) ---\n";
// Como el libro empaqueta 'asignar' en una función; aquí 'elegir' recibe el criterio.
function elegir(array $numeros, callable $criterio): int {
    foreach ($numeros as $n) {
        if ($criterio($n)) { return $n; }
    }
    return -1;
}
$esPar = fn(int $n): bool => $n % 2 === 0;
echo "primer par de [3,5,8,9]: " . elegir([3, 5, 8, 9], $esPar) . "\n"; // 8
