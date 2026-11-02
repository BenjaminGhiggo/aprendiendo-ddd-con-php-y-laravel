<?php
declare(strict_types=1);
// Ej2 — MALA: usa un código de error numérico (-1) que hay que recordar comprobar.
function buscarPrecio(array $precios, string $sku): int {
    return $precios[$sku] ?? -1;  // -1 significa "no encontrado"... si no lo olvidas
}
$p = buscarPrecio(["mesa" => 100], "silla");
echo $p . "\n"; // -1 (¿un precio de -1?)
