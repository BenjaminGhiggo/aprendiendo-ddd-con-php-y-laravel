<?php
declare(strict_types=1);
// Ej4 RETO — BUENA: dos lotes. La cascada reasigna la linea al segundo.
$lotes = ["l1" => 30, "l2" => 100]; // l2 tiene sitio
$linea = 50;
$destino = null;
foreach ($lotes as $ref => $disp) { if ($disp >= $linea) { $destino = $ref; break; } }
echo $destino === null ? "SinStock\n" : "reasignada a $destino\n"; // reasignada a l2
