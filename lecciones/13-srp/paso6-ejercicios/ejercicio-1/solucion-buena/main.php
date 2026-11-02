<?php
// BUENA: Pedido solo conoce la regla; recibo y guardado son responsabilidades aparte.
final class Pedido { public function __construct(public array $precios) {} public function total(): int { return array_sum($this->precios); } }
function imprimirRecibo(Pedido $p): void { echo "Total: " . $p->total() . "\n"; }
function guardar(Pedido $p): void { echo "guardando...\n"; }
$p = new Pedido([10, 20, 30]); imprimirRecibo($p); guardar($p);
