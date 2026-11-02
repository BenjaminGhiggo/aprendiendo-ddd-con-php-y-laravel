<?php
// MALA: un handler hace de todo (registrar + publicar), imposible de reusar por separado.
$registro = []; $canal = [];
function alAsignar(string $ref, string $sku, array &$registro, array &$canal): void {
    $registro[] = $ref; $canal[] = ["sku" => $sku]; // dos responsabilidades juntas
}
alAsignar("l1", "MESA", $registro, $canal);
echo count($registro) . " registro, " . count($canal) . " externo\n";
