<?php
// BUENA: un solo lugar declara y entrega las dependencias; entrypoint y test lo llaman.
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "e:$m\n"; } }
final class Bootstrap { public static function arrancar(?Notificaciones $n = null): Notificaciones { return $n ?? new Email(); } }
$n = Bootstrap::arrancar(); // mismo arranque para todos
$n->enviar("hola");
