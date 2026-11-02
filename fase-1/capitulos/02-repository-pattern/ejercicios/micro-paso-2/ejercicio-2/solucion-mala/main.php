<?php
// Ej2 — MALA: el "disponible" se guarda como dato; dos relaciones paralelas que se descuadran.
$comprado = 20; $asignado = [2, 2]; // ¿y si una línea estaba repetida?
echo "disponible: " . ($comprado - array_sum($asignado)) . "\n"; // 16 (mal si se repite)
