<?php
declare(strict_types=1);
// Ej1 — BUENA: si no hay stock, LANZA un error con nombre del negocio; no se puede ignorar.
class SinStock extends \Exception {}
function asignar(int $cantidad, int $disponible): int {
    if ($cantidad > $disponible) { throw new SinStock("sin stock"); }
    return $disponible - $cantidad;
}
try { echo asignar(99, 20) . "\n"; }
catch (SinStock $e) { echo "hay que reaccionar: " . $e->getMessage() . "\n"; }
