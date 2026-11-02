<?php
// Ej2 — BUENA: un acumulador recorre la lista; funciona con cualquier lista.
$notas = [10, 20, 30];
$suma = 0;
foreach ($notas as $n) { $suma = $suma + $n; }
echo "Suma: $suma\n";
