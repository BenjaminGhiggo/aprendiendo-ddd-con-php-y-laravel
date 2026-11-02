<?php
// MALA: asignar() cambia estado Y devuelve datos de lectura. Al repetir el POST, asigna doble.
$stock = 20;
function asignar(int &$stock, int $c): array { $stock -= $c; return ["disponible" => $stock]; }
print_r(asignar($stock, 2)); // si el navegador reenvía, vuelve a descontar
