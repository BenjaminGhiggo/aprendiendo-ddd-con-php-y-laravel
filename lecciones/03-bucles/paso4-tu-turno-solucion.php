<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.

// TODO 1
foreach (["rojo", "verde", "azul"] as $color) { echo "$color\n"; }

// TODO 2
$suma = 0;
foreach ([5, 10, 15] as $n) { $suma = $suma + $n; }
echo "Suma: $suma\n";

// TODO 3
$mult = 0;
foreach (range(1, 10) as $n) { if ($n % 3 === 0) { $mult++; } }
echo "Multiplos: $mult\n";

// TODO 4
foreach ([2, 4, 7, 8] as $n) { if ($n % 2 !== 0) { echo "Primer impar: $n\n"; break; } }

// Salida esperada:
// rojo
// verde
// azul
// Suma: 30
// Multiplos: 3
// Primer impar: 7
