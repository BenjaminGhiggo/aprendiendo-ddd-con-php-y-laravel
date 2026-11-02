<?php
// Ej1 — MALA: dos guardados sin transacción; si el segundo falla, el primero queda a medias.
$guardados = [];
$guardados[] = "lote-A";          // se guarda
// ... aquí falla el segundo paso, pero "lote-A" ya quedó guardado (estado inconsistente)
echo "guardado suelto: " . implode(",", $guardados) . "\n";
