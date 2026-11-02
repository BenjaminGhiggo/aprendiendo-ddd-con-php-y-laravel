<?php
declare(strict_types=1);
// Ej3 — MALA: el evento no lleva datos; el sku viaja por una global. Se desincroniza fácil.
$GLOBALS['ultimo_sku'] = null;
final class SinStock {}
function registrar(string $sku): SinStock {
    $GLOBALS['ultimo_sku'] = $sku; // canal paralelo
    return new SinStock();
}
$e = registrar("MESA");
echo "sin stock de " . $GLOBALS['ultimo_sku'] . "\n";
