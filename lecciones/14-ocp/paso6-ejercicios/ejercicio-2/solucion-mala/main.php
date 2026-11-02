<?php
// MALA: calcular área con if por tipo; cada figura nueva obliga a editar la función.
function area(string $figura, float $a, float $b): float {
    if ($figura === "rectangulo") { return $a * $b; }
    elseif ($figura === "cuadrado") { return $a * $a; }
    return 0;
}
echo area("cuadrado", 4, 0) . "\n";
