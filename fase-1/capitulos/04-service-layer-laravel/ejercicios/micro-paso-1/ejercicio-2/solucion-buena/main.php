<?php
declare(strict_types=1);
// BUENA: el servicio valida el sku antes de asignar y lanza una excepcion clara.
final class SkuInvalido extends \Exception {}
function skuValido(string $sku, array $skusDisponibles): bool {
    return in_array($sku, $skusDisponibles, true);
}
function servicioAsignar(string $sku, array $skusDisponibles): string {
    if (!skuValido($sku, $skusDisponibles)) {
        throw new SkuInvalido("Sku invalido {$sku}");
    }
    return "lote-1";
}
try {
    servicioAsignar("NO-EXISTE", ["LAMPARA"]);
} catch (SkuInvalido $e) {
    echo $e->getMessage() . "\n";   // Sku invalido NO-EXISTE
}
