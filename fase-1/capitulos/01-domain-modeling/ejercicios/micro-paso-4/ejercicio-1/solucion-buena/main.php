<?php
// Ej1 — BUENA: "elegir entre lotes" es un SERVICIO DE DOMINIO (una función), no un método.
final class Lote { public function __construct(public string $ref, public int $disponible) {} }
function asignar(int $cantidad, array $lotes): string {
    foreach ($lotes as $lote) { if ($lote->disponible >= $cantidad) return $lote->ref; }
    return "ninguno";
}
echo asignar(10, [new Lote("a", 5), new Lote("b", 100)]) . "\n"; // b
