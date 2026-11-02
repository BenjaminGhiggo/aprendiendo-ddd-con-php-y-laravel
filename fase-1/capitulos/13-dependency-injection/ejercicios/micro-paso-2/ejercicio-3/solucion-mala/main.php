<?php
// MALA: el test usa el Email real; imprime/manda de verdad y no puede comprobar qué se envió.
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "enviado de verdad: $m\n"; } }
$n = new Email();
$n->enviar("alerta"); // ¿cómo compruebo esto en un assert?
