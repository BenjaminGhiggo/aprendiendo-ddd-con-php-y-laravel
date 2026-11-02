<?php
// Ej3 — BUENA: con break, para en cuanto encuentra el primero; no sigue de gusto.
$numeros = [2, 4, 7, 8, 9];
foreach ($numeros as $n) { if ($n % 2 !== 0) { echo "Primer impar: $n\n"; break; } }
