<?php
// Ej3 — MALA: recorre TODA la lista aunque ya encontró el primero que cumple.
$numeros = [2, 4, 7, 8, 9];
$primero = null;
foreach ($numeros as $n) { if ($n % 2 !== 0 && $primero === null) { $primero = $n; } }
echo "Primer impar: $primero\n";
