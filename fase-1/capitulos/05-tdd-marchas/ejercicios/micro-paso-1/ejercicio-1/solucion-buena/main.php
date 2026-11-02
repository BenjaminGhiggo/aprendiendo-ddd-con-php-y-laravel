<?php
declare(strict_types=1);
// BUENA: el servicio recibe primitivos y arma la linea por dentro; el test solo pasa strings/ints.
final class LineaPedido {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    $linea = new LineaPedido($idPedido, $sku, $cantidad);   // el servicio ARMA la linea
    return "lote-1";
}
// test desacoplado: solo primitivos
echo servicioAsignar("o1", "LAMPARA", 10) . "\n";
