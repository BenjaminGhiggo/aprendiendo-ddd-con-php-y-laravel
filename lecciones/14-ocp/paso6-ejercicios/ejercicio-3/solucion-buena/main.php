<?php
// BUENA: la función recibe CÓMO avisar; un canal nuevo no la toca (OCP).
function avisar(callable $canal, string $msg): void { $canal($msg); }
avisar(fn(string $m) => print("EMAIL: $m\n"), "hola");
avisar(fn(string $m) => print("SMS: $m\n"), "hola");
