<?php
declare(strict_types=1);
// Ej2 — MALA: todo es Mensaje; para saber si es orden hay que leer un campo.
abstract class Mensaje { public string $clase = "?"; }
final class Asignar extends Mensaje { public string $clase = "comando"; }
final class Asignado extends Mensaje { public string $clase = "evento"; }
$m = new Asignar();
echo $m->clase === "comando" ? "es orden\n" : "es hecho\n"; // fragil: depende del string
