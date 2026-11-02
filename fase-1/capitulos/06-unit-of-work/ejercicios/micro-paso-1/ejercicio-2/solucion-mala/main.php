<?php
// Ej2 — MALA: el servicio recibe "repo" y "sesion" sueltos y se olvida de confirmar.
function agregar(array &$repo, bool &$confirmado, string $ref): void {
    $repo[] = $ref;   // guarda en el repo, pero NUNCA confirma
}
$repo = []; $confirmado = false;
agregar($repo, $confirmado, "lote-1");
echo "confirmado: " . var_export($confirmado, true) . "\n"; // false (se perdió)
