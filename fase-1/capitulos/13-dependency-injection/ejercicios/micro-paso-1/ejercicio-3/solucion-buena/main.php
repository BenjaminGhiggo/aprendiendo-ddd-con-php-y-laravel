<?php
// BUENA: ligas la interfaz a una implementación en el contenedor; pides por la interfaz.
require __DIR__ . "/../../../../../../../vendor/autoload.php";
use Illuminate\Container\Container;
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "e:$m\n"; } }
$c = new Container();
$c->bind(Notificaciones::class, Email::class);      // liga abstracción -> implementación
$c->make(Notificaciones::class)->enviar("hola");     // pide por la abstracción
