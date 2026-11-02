<?php
declare(strict_types=1);
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.

// TODO 1
function doble(int $n): int { return $n * 2; }
echo doble(5) . "\n";

// TODO 2
function saludar(string $nombre = "mundo"): string { return "hola, $nombre"; }
echo saludar() . "\n";
echo saludar("Ana") . "\n";

// TODO 3
$triple = fn(int $n): int => $n * 3;
echo $triple(4) . "\n";

// TODO 4
function aplicar(int $valor, callable $f): int { return $f($valor); }
echo aplicar(10, $triple) . "\n";

// Salida esperada:
// 10
// hola, mundo
// hola, Ana
// 12
// 30
