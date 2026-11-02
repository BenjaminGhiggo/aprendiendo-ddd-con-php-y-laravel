<?php
// Ej2-BUENA: validar el sku ANTES de asignar; si es inválido, se lanza y no se toca nada.
final class SkuInvalido extends \Exception {}
$lotes = ["MESA"];
function asignar(array $lotes, string $sku): string {
    if (!in_array($sku, $lotes)) { throw new SkuInvalido("Sku inválido $sku"); }
    return "asignado";
}
try { echo asignar($lotes, "INEXISTENTE") . "\n"; }
catch (SkuInvalido $e) { echo "rechazado antes de tocar nada: " . $e->getMessage() . "\n"; }
