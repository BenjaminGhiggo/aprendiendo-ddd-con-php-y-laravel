<?php
declare(strict_types=1);
// BUENA: el test pasa primitivos; cambie como cambie el constructor, el test NO se toca.
final class LineaPedido {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    $linea = new LineaPedido($idPedido, $sku, $cantidad);   // el unico lugar que conoce el constructor
    return "lote-1";
}
// Si el constructor cambia, solo cambia el servicio; este test sigue igual:
echo servicioAsignar("o1", "LAMPARA", 10) . "\n";
