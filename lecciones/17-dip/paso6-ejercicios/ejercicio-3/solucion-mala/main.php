<?php
// Ej3 — MALA (funciona): el reporte decide adentro de dónde saca los datos.
function totalVentas(): int {
    $ventas = [100, 200, 300];   // datos "cableados" dentro de la lógica
    return array_sum($ventas);
}
echo totalVentas() . "\n";
// No puedo calcular el total con OTRAS ventas sin editar la función.
