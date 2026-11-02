<?php
// Ej1 — BUENA: una frontera atómica: o se confirman los dos, o ninguno.
function ejecutarAtomico(callable $trabajo): void {
    $pendientes = [];
    try { $trabajo($pendientes); }
    catch (\Throwable $e) { $pendientes = []; echo "deshecho todo por: " . $e->getMessage() . "\n"; return; }
    echo "confirmado: " . implode(",", $pendientes) . "\n";
}
ejecutarAtomico(function (array &$p) { $p[] = "lote-A"; $p[] = "lote-B"; });
