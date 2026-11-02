<?php
// BUENA: la función pide la INTERFAZ; acepta cualquier implementación.
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "e:$m\n"; } }
function avisar(Notificaciones $n, string $m): void { $n->enviar($m); }
avisar(new Email(), "hola");
