<?php
// Ej2 — BUENA: cada clase sabe enviarse; el bucle llama al mismo método, sin ifs.
interface Notificador { public function enviar(string $m): string; }
class Email implements Notificador { public function enviar(string $m): string { return "EMAIL: $m"; } }
class Sms implements Notificador { public function enviar(string $m): string { return "SMS: $m"; } }
foreach ([new Email(), new Sms()] as $n) { echo $n->enviar("hola") . "\n"; }
