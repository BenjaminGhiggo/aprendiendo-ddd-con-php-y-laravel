<?php
// MALA: un if/elif que crece con cada descuento nuevo (hay que editar la función).
function precio(float $base, string $codigo): float {
    if ($codigo === "ninguno") { return $base; }
    elseif ($codigo === "10") { return $base * 0.9; }
    return $base;
}
echo precio(100, "10") . "\n";
