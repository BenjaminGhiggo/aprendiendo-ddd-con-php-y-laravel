<?php
// Ej2 — BUENA: el notificador se inyecta; el servicio no depende de uno concreto.
interface Notificador { public function enviar(string $msg): void; }
final class NotificadorEmail implements Notificador {
    public function enviar(string $msg): void { echo "email: " . $msg . "\n"; }
}
final class NotificadorSms implements Notificador {
    public function enviar(string $msg): void { echo "sms: " . $msg . "\n"; }
}
function avisarCompra(Notificador $notificador): void {
    $notificador->enviar("Compra realizada");
}
avisarCompra(new NotificadorEmail());
avisarCompra(new NotificadorSms());
