<?php
// MALA: la función exige Email concreto; no puedes pasar un SMS ni una falsa.
final class Email { public function enviar(string $m): void { echo "e:$m\n"; } }
function avisar(Email $n, string $m): void { $n->enviar($m); } // atado a Email
avisar(new Email(), "hola");
