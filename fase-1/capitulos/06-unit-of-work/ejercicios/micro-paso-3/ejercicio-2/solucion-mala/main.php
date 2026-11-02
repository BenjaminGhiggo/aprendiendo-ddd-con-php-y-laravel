<?php
// Ej2-MALA: validar el sku DESPUÉS de asignar; ya se tocó el estado aunque el sku fuera inválido.
$lotes = ["MESA"];
function asignar(array $lotes, string $sku): string {
    $resultado = "asignado-a-algo"; // ya asignamos...
    if (!in_array($sku, $lotes)) { return "sku inválido (pero ya tocamos cosas)"; }
    return $resultado;
}
echo asignar($lotes, "INEXISTENTE") . "\n";
