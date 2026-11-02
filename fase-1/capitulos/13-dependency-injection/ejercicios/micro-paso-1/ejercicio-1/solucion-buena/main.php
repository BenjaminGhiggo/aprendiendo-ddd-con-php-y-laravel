<?php
// BUENA: el handler recibe la dependencia (una abstracción) -> explícita, fácil de cambiar/testear.
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "email: $m\n"; } }
function notificarSinStock(string $sku, Notificaciones $n): void { $n->enviar("sin stock $sku"); }
notificarSinStock("MESA", new Email());
