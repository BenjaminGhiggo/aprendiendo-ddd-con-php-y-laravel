<?php
// Ej1 — MALA: un if por cada tipo; al llegar un tipo nuevo hay que tocar esta función.
function area(string $tipo, float $x): float {
    if ($tipo === "cuadrado") { return $x * $x; }
    if ($tipo === "circulo") { return 3.14 * $x * $x; }
    return 0.0; // ¿y el rectángulo de mañana?
}
echo area("cuadrado", 4) . "\n";
