<?php
// MALA: el entrypoint y el test arman lo mismo por separado -> duplicación, se desincronizan.
interface Notificaciones { public function enviar(string $m): void; }
final class Email implements Notificaciones { public function enviar(string $m): void { echo "e:$m\n"; } }
$n1 = new Email(); // en el entrypoint
$n2 = new Email(); // y otra vez en el test...
$n1->enviar("hola");
