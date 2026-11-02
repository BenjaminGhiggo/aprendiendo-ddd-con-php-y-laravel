<?php
// Ej1 — MALA: "elegir entre lotes" como método del Lote: un lote no conoce a los demás.
final class Lote {
    public function __construct(public string $ref, public int $disponible) {}
    public function asignarEntre(array $otros): string {
        foreach ($otros as $l) { if ($l->disponible >= 10) return $l->ref; }
        return "ninguno";
    }
}
$a = new Lote("a", 5);
echo $a->asignarEntre([$a, new Lote("b", 100)]) . "\n";
