<?php
// BUENA: el negocio pide la interfaz; el canal se elige fuera (una línea).
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "email:$m\n"; } }
final class Sms implements Notificaciones { public function enviar(string $m): void { echo "sms:$m\n"; } }
function avisar(Notificaciones $n, string $m): void { $n->enviar($m); }
$canal = new Sms();         // <- la única línea que cambia
avisar($canal, "hola");
