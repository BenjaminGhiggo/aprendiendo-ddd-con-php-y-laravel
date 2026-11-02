<?php
declare(strict_types=1);
// Calculos.php — módulo de apoyo para el solucionario (problemas 🟢/🟡).
function sumar(int $a, int $b): int { return $a + $b; }
function esPar(int $n): bool { return $n % 2 === 0; }
function mayor(int $a, int $b): int { return $a >= $b ? $a : $b; }
