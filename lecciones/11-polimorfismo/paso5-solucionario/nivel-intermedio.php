<?php
declare(strict_types=1);
// nivel-intermedio.php — 🟡 5–8.
interface Notificador { public function enviar(string $msg): string; }
class Email implements Notificador { public function enviar(string $msg): string { return "EMAIL: $msg"; } }
class Sms implements Notificador { public function enviar(string $msg): string { return "SMS: $msg"; } }
$canales = [new Email(), new Sms()];
echo "P5:\n";
foreach ($canales as $canal) { echo $canal->enviar("hola") . "\n"; }    // recorrer, mismo método
function avisar(Notificador $n, string $m): string { return $n->enviar($m); }
echo "P6: " . avisar(new Email(), "stock") . "\n";             // EMAIL: stock
echo "P7: " . avisar(new Sms(), "stock") . "\n";               // SMS: stock
echo "P8: " . count($canales) . " canales\n";                  // 2 canales
