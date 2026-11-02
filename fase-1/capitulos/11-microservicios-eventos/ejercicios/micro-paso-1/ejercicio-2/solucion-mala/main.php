<?php
// MALA: el dominio llama directo a Envios -> acoplamiento temporal (Envios debe estar vivo ahora).
final class Envios { public static function crear(string $sku): void { echo "envío creado: $sku\n"; } }
function asignar(string $sku): void { /* ...reglas... */ Envios::crear($sku); }
asignar("MESA");
