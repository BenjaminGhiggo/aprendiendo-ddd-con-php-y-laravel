<?php
// BUENA: el evento externo es un array plano (se serializa a JSON). Desacopla servicios.
final class Asignado { public function __construct(public readonly string $idPedido, public readonly string $sku) {} }
$canal = [];
$ev = new Asignado("o1", "MESA");
$canal[] = ["id_pedido" => $ev->idPedido, "sku" => $ev->sku]; // datos planos
echo json_encode($canal[0]) . "\n";
