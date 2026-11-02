<?php
// BUENA: separadas. El comando solo escribe (no devuelve datos); la consulta solo lee.
$stock = 20;
function asignar(int &$stock, int $c): void { $stock -= $c; }           // solo escribe
function disponible(int $stock): int { return $stock; }                 // solo lee
asignar($stock, 2);
echo disponible($stock) . "\n";
