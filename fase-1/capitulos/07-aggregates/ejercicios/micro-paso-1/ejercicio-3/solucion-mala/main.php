<?php
// Ej3-MALA: si ningun lote puede, devuelve un string vacio (el error pasa desapercibido).
function asignar(array $lotes, int $cantidad): string {
    foreach ($lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
    return ""; // nadie se entera de que no habia stock
}
echo "ref='" . asignar([['ref' => 'l1', 'disponible' => 5]], 10) . "'\n"; // ref='' (silencioso)
