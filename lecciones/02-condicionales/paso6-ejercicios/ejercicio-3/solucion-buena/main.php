<?php
// Ej3 — BUENA: una sola decisión; la condición vive en un solo lugar.
$monto = 100;
if ($monto >= 100) { echo "Aplica descuento\n"; $total = $monto * 0.9; }
else { $total = $monto; }
echo "$total\n";
