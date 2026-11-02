<?php
declare(strict_types=1);
// BUENA: caso de uso en marcha ALTA (servicio con primitivos): el test expresa el comportamiento, no el detalle.
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    // el servicio orquesta por dentro
    return "lote-1";
}
$ref = servicioAsignar("o1", "LAMPARA", 10);   // solo primitivos, comportamiento
echo $ref . "\n";                              // lote-1
