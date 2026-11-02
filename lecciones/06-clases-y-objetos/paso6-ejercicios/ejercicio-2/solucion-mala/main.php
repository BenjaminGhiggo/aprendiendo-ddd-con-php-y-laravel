<?php
declare(strict_types=1);
// Ej2 — MALA: la regla (puede asignar) vive FUERA del objeto, en una función suelta.
class Lote { public function __construct(public string $sku, public int $disponible) {} }
function puedeAsignar(Lote $lote, string $sku, int $cantidad): bool {
    return $lote->sku === $sku && $lote->disponible >= $cantidad;  // hurga en los datos ajenos
}
$lote = new Lote("MESA", 20);
echo var_export(puedeAsignar($lote, "MESA", 5), true) . "\n";
