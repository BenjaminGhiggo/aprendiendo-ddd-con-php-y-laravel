<?php
// Ej3 — BUENA: una interfaz obliga a que TODOS tengan el MISMO método; la función no adivina.
interface Notificador { public function enviar(string $m): string; }
class Email implements Notificador { public function enviar(string $m): string { return "EMAIL: $m"; } }
class Sms implements Notificador { public function enviar(string $m): string { return "SMS: $m"; } }
function avisar(Notificador $canal, string $m): string { return $canal->enviar($m); }
echo avisar(new Email(), "hola") . "\n";
