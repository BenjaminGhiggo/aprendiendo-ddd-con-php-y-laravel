<?php
declare(strict_types=1);
// BUENA: elijo la marcha segun el momento.
// (a) regla NUEVA y dudosa -> marcha baja (dominio), test fino que la aisla:
function compararLotes(?string $etaA, ?string $etaB): int {
    return ($etaA === null ? 0 : 1) <=> ($etaB === null ? 0 : 1);
}
echo (compararLotes(null, "2025-01-01") < 0 ? "regla OK (marcha baja)" : "mal") . "\n";
// (b) caso de uso ESTABLE -> marcha alta (servicio), test de comportamiento:
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string { return "lote-1"; }
echo "caso de uso: " . servicioAsignar("o1", "LAMPARA", 10) . " (marcha alta)\n";
