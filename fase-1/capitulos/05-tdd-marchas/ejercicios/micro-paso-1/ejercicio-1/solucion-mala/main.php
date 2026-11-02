<?php
declare(strict_types=1);
// MALA: el servicio recibe un objeto de dominio; el test debe construirlo (acoplado al constructor).
final class LineaPedido {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(LineaPedido $linea): string {
    return "lote-1";
}
// test acoplado: tiene que saber como se construye LineaPedido
echo servicioAsignar(new LineaPedido("o1", "LAMPARA", 10)) . "\n";
