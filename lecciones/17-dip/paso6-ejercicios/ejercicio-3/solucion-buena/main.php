<?php
// Ej3 — BUENA: los datos entran por parámetro; la lógica no depende de su origen.
function totalVentas(array $ventas): int {
    return array_sum($ventas);
}
echo totalVentas([100, 200, 300]) . "\n";
echo totalVentas([5, 5]) . "\n";   // funciona con cualquier fuente de datos
