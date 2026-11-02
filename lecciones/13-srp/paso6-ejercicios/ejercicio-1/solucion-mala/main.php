<?php
// MALA: Pedido calcula, imprime recibo y se guarda: tres razones para cambiar.
final class Pedido {
    public function __construct(public array $precios) {}
    public function total(): int { return array_sum($this->precios); }
    public function imprimirRecibo(): void { echo "Total: " . $this->total() . "\n"; }
    public function guardar(): void { echo "guardando...\n"; }
}
$p = new Pedido([10, 20, 30]); $p->imprimirRecibo(); $p->guardar();
