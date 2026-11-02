<?php
// Ej3 — MALA: repite la condición del descuento en dos lugares.
$monto = 100; $total = $monto;
if ($monto >= 100) { echo "Aplica descuento\n"; }
if ($monto >= 100) { $total = $monto * 0.9; }
echo "$total\n";
