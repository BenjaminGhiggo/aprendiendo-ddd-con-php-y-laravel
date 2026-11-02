<?php
declare(strict_types=1);
// BUENA: regla fina en marcha BAJA (dominio): el test apunta exactamente a la regla de orden.
final class Lote {
    public function __construct(public readonly string $ref, public readonly ?string $eta) {}
}
function compararLotes(Lote $a, Lote $b): int {
    // sin eta (en stock) va antes que con eta
    return ($a->eta === null ? 0 : 1) <=> ($b->eta === null ? 0 : 1);
}
$enStock = new Lote("en-stock", null);
$enCamino = new Lote("en-camino", "2025-01-01");
echo (compararLotes($enStock, $enCamino) < 0 ? "en-stock primero" : "mal") . "\n";
