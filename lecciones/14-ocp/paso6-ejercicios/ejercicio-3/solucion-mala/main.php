<?php
// MALA: para avisar por otro canal hay que editar la función.
function avisar(string $canal, string $msg): void {
    if ($canal === "email") { echo "EMAIL: $msg\n"; }
    elseif ($canal === "sms") { echo "SMS: $msg\n"; }
}
avisar("email", "hola");
