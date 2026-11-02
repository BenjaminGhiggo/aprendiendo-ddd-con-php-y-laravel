<?php
// BUENA: un registro {código => función}; un descuento nuevo es una entrada nueva (OCP).
$descuentos = ["ninguno" => fn(float $p) => $p, "10" => fn(float $p) => $p * 0.9];
function precio(array $d, float $base, string $codigo): float { return $d[$codigo]($base); }
echo precio($descuentos, 100, "10") . "\n";
