<?php
declare(strict_types=1);
// MALA: la validacion del sku se olvida; el servicio asigna a ciegas y falla raro despues.
function servicioAsignar(string $sku, array $lotes): string {
    // sin validar: si el sku no esta, $lotes[0] podria ni corresponder
    return $lotes[0] ?? "???";
}
echo servicioAsignar("NO-EXISTE", ["LAMPARA" => "lote-1"] === [] ? [] : []) . "\n";
