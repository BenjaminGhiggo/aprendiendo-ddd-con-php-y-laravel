<?php
// BUENA: cada responsabilidad en su función; se combinan y se reutilizan por separado.
function esNumero(string $texto): bool { return ctype_digit($texto); }
function mensajeEdad(int $edad): string { return "Tienes " . $edad . " años"; }
$texto = "30";
echo esNumero($texto) ? mensajeEdad((int) $texto) . "\n" : "Edad inválida\n";
