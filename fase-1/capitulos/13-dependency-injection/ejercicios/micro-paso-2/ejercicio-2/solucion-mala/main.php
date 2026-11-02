<?php
// MALA: el canal está escrito dentro; para usar SMS hay que editar la función.
final class Email { public function enviar(string $m): void { echo "email:$m\n"; } }
function avisar(string $m): void { (new Email())->enviar($m); } // para SMS, editar aquí
avisar("hola");
