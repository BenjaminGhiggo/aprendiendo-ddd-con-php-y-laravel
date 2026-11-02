<?php
declare(strict_types=1);
// Ej4 RETO — MALA: un solo lote. Al bajarlo, la linea de 50 no tiene donde ir.
$lotes = ["l1" => 30]; // disponible tras bajar
$linea = 50;
$destino = null;
foreach ($lotes as $ref => $disp) { if ($disp >= $linea) { $destino = $ref; break; } }
echo $destino === null ? "SinStock: la linea de $linea no cupo\n" : "asignada a $destino\n";
