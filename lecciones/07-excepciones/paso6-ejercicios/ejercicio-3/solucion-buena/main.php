<?php
declare(strict_types=1);
// Ej3 — BUENA: atrapa SOLO lo que sabe manejar y deja que el resto suba.
function procesar(string $dato): string {
    if ($dato === "") { throw new \InvalidArgumentException("vacío"); }
    return "ok: $dato";
}
try { echo procesar("") . "\n"; }
catch (\InvalidArgumentException $e) { echo "entrada inválida: " . $e->getMessage() . "\n"; }
