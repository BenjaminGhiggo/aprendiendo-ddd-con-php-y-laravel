<?php
declare(strict_types=1);
// Ej4 RETO — BUENA: Desasignar extends Comando; el bus lo trata como orden.
abstract class Comando {}
abstract class Evento {}
final class Desasignar extends Comando { public function __construct(public readonly string $idPedido, public readonly string $sku) {} }
$d = new Desasignar("o1", "MESA");
echo $d instanceof Comando ? "es orden\n" : "mal\n";
echo $d instanceof Evento ? "mal\n" : "no es evento\n";
