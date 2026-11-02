<?php
// BUENA: una falsa guarda lo enviado; el test lee ->enviadas y hace assert sin efectos reales.
interface Notificaciones { public function enviar(string $m): void; }
final class NotificacionesFalsas implements Notificaciones { public array $enviadas = []; public function enviar(string $m): void { $this->enviadas[] = $m; } }
$n = new NotificacionesFalsas();
$n->enviar("alerta");
echo $n->enviadas[0] . "\n"; // el test comprobaría assertSame(["alerta"], $n->enviadas)
