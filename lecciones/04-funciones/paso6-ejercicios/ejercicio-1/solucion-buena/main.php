<?php
declare(strict_types=1);
// Ej1 — BUENA: una función empaqueta el cálculo; se cambia en un solo sitio.
function area(int $base, int $altura): int { return $base * $altura; }
echo area(4, 3) . "\n";
echo area(5, 2) . "\n";
echo area(10, 6) . "\n";
