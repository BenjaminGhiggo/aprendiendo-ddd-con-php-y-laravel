<?php
// MALA: la salida llama a un cliente HTTP concreto; atada a ESE servicio y a ESE transporte.
final class ClienteEnvios { public function post(string $sku): void { echo "POST envios: $sku\n"; } }
function publicarAsignado(string $sku): void { (new ClienteEnvios())->post($sku); }
publicarAsignado("MESA");
