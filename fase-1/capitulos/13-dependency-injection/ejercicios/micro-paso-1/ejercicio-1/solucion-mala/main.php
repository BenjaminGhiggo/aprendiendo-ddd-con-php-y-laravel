<?php
// MALA: el handler crea el email concreto dentro -> dependencia implícita, difícil de testear.
final class Email { public function enviar(string $m): void { echo "email: $m\n"; } }
function notificarSinStock(string $sku): void { (new Email())->enviar("sin stock $sku"); }
notificarSinStock("MESA");
