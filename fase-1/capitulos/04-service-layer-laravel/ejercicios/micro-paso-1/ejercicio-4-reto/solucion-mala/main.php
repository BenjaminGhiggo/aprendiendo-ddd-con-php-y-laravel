<?php
declare(strict_types=1);
// MALA: el servicio asigna pero NUNCA confirma; los cambios no se persisten.
function servicioAsignar(string $sku): string {
    $referencia = "lote-1";   // ... asigno ...
    // falta el commit: en una BD real esto se perderia al cerrar
    return $referencia;
}
echo servicioAsignar("LAMPARA") . "\n";
