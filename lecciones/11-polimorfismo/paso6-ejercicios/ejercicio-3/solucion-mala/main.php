<?php
// Ej3 — MALA: la función recibe "mixed" y adivina qué método llamar.
class Email { public function mandar(string $m): string { return "EMAIL: $m"; } }
class Sms { public function textear(string $m): string { return "SMS: $m"; } } // ¡método con otro nombre!
function avisar(object $canal, string $m): string {
    if ($canal instanceof Email) { return $canal->mandar($m); }
    if ($canal instanceof Sms) { return $canal->textear($m); }
    return "";
}
echo avisar(new Email(), "hola") . "\n";
