<?php
declare(strict_types=1);
// Ej4 RETO — MALA: Desasignar no hereda de Comando; el bus no sabe que es una orden.
abstract class Comando {}
final class Desasignar { public function __construct(public readonly string $idPedido, public readonly string $sku) {} }
$d = new Desasignar("o1", "MESA");
echo $d instanceof Comando ? "es orden\n" : "NO es orden (mal)\n";
