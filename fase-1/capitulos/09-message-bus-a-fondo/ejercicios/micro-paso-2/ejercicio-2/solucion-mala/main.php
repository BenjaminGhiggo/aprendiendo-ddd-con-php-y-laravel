<?php
declare(strict_types=1);
// Ej2 — MALA: la linea desasignada se pierde; nadie la reasigna.
$asignaciones = [["o1","MESA",50]];
$comprada = 30;
while ($comprada - array_sum(array_map(fn($a) => $a[2], $asignaciones)) < 0) {
    array_pop($asignaciones); // se cae al vacio
}
echo "lineas pendientes de reasignar: 0 (se perdieron)\n";
