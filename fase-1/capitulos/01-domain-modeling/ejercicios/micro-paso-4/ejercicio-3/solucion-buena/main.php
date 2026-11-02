<?php
// Ej3 — BUENA: "no hay stock" lanza una excepción con nombre del negocio; no se puede ignorar.
final class SinStock extends \Exception {}
final class Lote { public function __construct(public string $ref, public int $disponible) {} }
function asignar(int $cantidad, array $lotes): string {
    foreach ($lotes as $l) { if ($l->disponible >= $cantidad) return $l->ref; }
    throw new SinStock("Sin stock");
}
try { asignar(999, [new Lote("a", 5)]); }
catch (SinStock $e) { echo "hay que reaccionar: " . $e->getMessage() . "\n"; }
