<?php
declare(strict_types=1);
// Ej2 — BUENA: Comando y Evento son jerarquias distintas; instanceof decide.
abstract class Comando {}
abstract class Evento {}
final class Asignar extends Comando {}
final class Asignado extends Evento {}
$m = new Asignar();
echo $m instanceof Comando ? "es orden\n" : "es hecho\n";
