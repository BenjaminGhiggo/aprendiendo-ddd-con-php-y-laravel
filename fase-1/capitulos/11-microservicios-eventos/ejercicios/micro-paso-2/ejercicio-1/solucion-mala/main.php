<?php
// MALA: el adaptador de entrada mete reglas de negocio -> transporte y dominio mezclados.
function consumir(array $msg): string {
    if ($msg["cantidad"] < 0) { return "ignorado"; }      // ¡regla de negocio aquí!
    return "lote {$msg["ref"]} a {$msg["cantidad"]}";
}
echo consumir(["ref" => "l1", "cantidad" => 5]) . "\n";
