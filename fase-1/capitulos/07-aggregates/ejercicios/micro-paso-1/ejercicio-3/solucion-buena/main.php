<?php
// Ej3-BUENA: si ningun lote puede, el agregado LANZA SinStock (el error es explicito).
final class SinStock extends \Exception {}
function asignar(array $lotes, int $cantidad): string {
    foreach ($lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
    throw new SinStock("Sin stock");
}
try { echo asignar([['ref' => 'l1', 'disponible' => 5]], 10) . "\n"; }
catch (SinStock $e) { echo "lanzado: {$e->getMessage()}\n"; }
