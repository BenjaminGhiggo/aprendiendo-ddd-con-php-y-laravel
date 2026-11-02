<?php
// MALA: una sola función valida, convierte y formatea.
function procesarEdad(string $texto): string {
    if (!ctype_digit($texto)) { return "Edad inválida"; }
    $edad = (int) $texto;
    return "Tienes " . $edad . " años";
}
echo procesarEdad("30") . "\n";
