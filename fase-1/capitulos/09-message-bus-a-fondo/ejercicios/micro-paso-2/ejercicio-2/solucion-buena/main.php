<?php
declare(strict_types=1);
// Ej2 — BUENA: cada linea desasignada genera un AsignacionRequerida.
final class AsignacionRequerida {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
$asignaciones = [["o1","MESA",50]];
$comprada = 30;
$eventos = [];
while ($comprada - array_sum(array_map(fn($a) => $a[2], $asignaciones)) < 0) {
    [$id,$sku,$cant] = array_pop($asignaciones);
    $eventos[] = new AsignacionRequerida($id, $sku, $cant);
}
echo "eventos para reasignar: " . count($eventos) . " (" . $eventos[0]->sku . " " . $eventos[0]->cantidad . ")\n";
