<?php
// Ej2 — MALA (funciona): el servicio instancia el notificador concreto.
final class NotificadorEmail {
    public function enviar(string $msg): void { echo "email: " . $msg . "\n"; }
}
function avisarCompra(): void {
    $notificador = new NotificadorEmail();   // atado a email; cambiarlo obliga a tocar esto
    $notificador->enviar("Compra realizada");
}
avisarCompra();
