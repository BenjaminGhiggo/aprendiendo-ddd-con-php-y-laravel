<?php
// Ej3 — MALA: cuando no hay stock devuelve "ninguno", que el que llama puede olvidar comprobar.
final class Lote { public function __construct(public string $ref, public int $disponible) {} }
function asignar(int $cantidad, array $lotes): string {
    foreach ($lotes as $l) { if ($l->disponible >= $cantidad) return $l->ref; }
    return "ninguno";
}
$ref = asignar(999, [new Lote("a", 5)]);
echo "asignado a: $ref\n"; // "ninguno" pasa desapercibido
