<?php
declare(strict_types=1);
// Ej1 — BUENA: una clase agrupa los datos que van juntos en un solo objeto.
class Lote {
    public function __construct(public string $referencia, public string $sku, public int $comprado) {}
}
$lote = new Lote("lote-001", "MESA", 20);
echo "{$lote->referencia} {$lote->sku} {$lote->comprado}\n";
