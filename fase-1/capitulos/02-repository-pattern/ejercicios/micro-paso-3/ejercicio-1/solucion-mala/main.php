<?php
// Ej1 — MALA: el servicio decide si usar el falso o la BD con un if; conoce ambos.
function servicio(string $modo): int {
    if ($modo === "test") { return 20; }              // falso embebido
    else { /* consulta a la BD */ return 20; }         // real embebido
}
echo servicio("test") . "\n";
