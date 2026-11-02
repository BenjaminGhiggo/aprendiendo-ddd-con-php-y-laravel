<?php
declare(strict_types=1);
// Ej3 — BUENA: el bus reparte por el tipo real del objeto.
abstract class Comando {}
abstract class Evento {}
final class Asignar extends Comando {}
function manejar(object $m): void {
    if ($m instanceof Comando) { echo "rama comando\n"; }
    else { echo "rama evento\n"; }
}
manejar(new Asignar());
