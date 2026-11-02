<?php
// Ej3-MALA: el servicio ordena lotes y valida stock A MANO (lógica que es del agregado).
function servicioAsignar(array $lotes, int $cantidad): string {
    usort($lotes, fn($a, $b) => $a['disponible'] <=> $b['disponible']); // negocio en el servicio
    foreach ($lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
    return "";
}
echo servicioAsignar([['ref' => 'l1', 'disponible' => 100]], 10) . "\n";
