<?php
// MALA: pides la clase concreta directamente; el código queda atado a ella.
final class Email { public function enviar(string $m): void { echo "e:$m\n"; } }
$n = new Email();   // concreto
$n->enviar("hola");
