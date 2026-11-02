<?php
// paso1-formulas.php — PASO 1 de la Lección 03.
// Ejecuta:  php lecciones/03-bucles/paso1-formulas.php

echo "--- for (sabes cuántas vueltas) ---\n";
// R1 · for con range de números: desde 0 hasta <3.
echo "R1  for 0..2: ";
for ($i = 0; $i < 3; $i++) { echo "$i "; }
echo "\n";

// R2 · recorrer un array con for y su índice.
$productos = ["mesa", "silla", "lámpara"];
echo "R2  por índice:\n";
for ($i = 0; $i < count($productos); $i++) { echo "  [$i] {$productos[$i]}\n"; }

echo "\n--- foreach (lo normal para recorrer) ---\n";
// R3 · foreach: una vuelta por cada elemento (a fondo en la Lección 05).
echo "R3  foreach:\n";
foreach ($productos as $prod) { echo "  -> $prod\n"; }

// R4 · range(a, b): genera una lista de números para recorrer.
echo "R4  range(1,5): ";
foreach (range(1, 5) as $n) { echo "$n "; }
echo "\n";

echo "\n--- acumuladores y contadores ---\n";
// R5 · sumar (acumulador): empieza en 0 y va creciendo.
$suma = 0;
foreach ([12, 15, 9, 18] as $nota) { $suma = $suma + $nota; }
echo "R5  suma: $suma\n";                  // 54

// R6 · multiplicar (acumulador): empieza en 1.
$producto = 1;
foreach ([1, 2, 3, 4] as $x) { $producto = $producto * $x; }
echo "R6  producto: $producto\n";          // 24

// R7 · contar cuántos cumplen una condición.
$pares = 0;
foreach (range(1, 10) as $n) { if ($n % 2 === 0) { $pares++; } }
echo "R7  pares del 1 al 10: $pares\n";     // 5

echo "\n--- while y control ---\n";
// W1 · while: repetir MIENTRAS una condición sea verdadera.
echo "W1  while: ";
$i = 0;
while ($i < 3) { echo "$i "; $i++; }        // ¡sube $i o será infinito!
echo "\n";

// W2 · break: salir del bucle antes de tiempo (el primero que cumple).
echo "W2  primer > 3: ";
foreach ([1, 2, 3, 4, 5] as $n) { if ($n > 3) { echo "$n"; break; } }
echo "\n";

// W3 · continue: saltarse una vuelta y seguir con la siguiente.
echo "W3  impares (saltando pares): ";
foreach (range(1, 6) as $n) { if ($n % 2 === 0) { continue; } echo "$n "; }
echo "\n";

// W4 · "el primero que puede asignar" (como el libro, con break).
$lotes = [["l1", 5], ["l2", 100], ["l3", 3]]; // [referencia, disponible]
$pedido = 10;
echo "W4  lote elegido: ";
foreach ($lotes as $lote) { if ($lote[1] >= $pedido) { echo $lote[0]; break; } }
echo "\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8):
// while (true) { }      // E1 -> bucle INFINITO (nunca para): asegúrate de que algo cambie
// echo 5 % 0;           // E3 -> DivisionByZeroError: Modulo by zero
// ---------------------------------------------------------------------------
