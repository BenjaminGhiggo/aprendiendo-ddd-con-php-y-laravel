<?php
declare(strict_types=1);
// Ej1 — MALA: una sola pasada. El evento que genera el handler nunca se procesa.
$mensajes = ["A"];
$generados = [];
foreach ($mensajes as $m) {
    echo "proceso $m\n";
    if ($m === "A") { $generados[] = "B"; } // B queda fuera del foreach
}
echo "sin procesar: " . implode(",", $generados) . "\n";
