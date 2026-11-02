<?php
declare(strict_types=1);
// Ej1 — BUENA: desasignamos lineas hasta que disponible >= 0.
$comprada = 30;              // nuevo requisito
$asignaciones = [50];        // una linea de 50 asignada
$desasignadas = [];
while ($comprada - array_sum($asignaciones) < 0) {
    $desasignadas[] = array_pop($asignaciones); // quitamos la que ya no cabe
}
echo "disponible: " . ($comprada - array_sum($asignaciones)) . "\n"; // 30
echo "desasignadas: " . implode(",", $desasignadas) . "\n";          // 50
