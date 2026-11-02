<?php
// MALA: publicamos el objeto de dominio al exterior; otros servicios quedan atados a NUESTRA clase.
final class Asignado { public function __construct(public readonly string $idPedido, public readonly string $sku) {} }
$canal = [];
$ev = new Asignado("o1", "MESA");
$canal[] = $ev; // un objeto PHP; nadie fuera de este servicio puede leerlo
echo get_class($canal[0]) . "\n";
