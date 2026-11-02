<?php
// Ej1 — BUENA: una clase agrupa los datos (con Eloquent, además sabría guardarse con ->save()).
final class Lote {
    public function __construct(public string $referencia, public string $sku, public int $cantidad) {}
}
$lote = new Lote("lote-1", "MESA", 20);
echo "{$lote->referencia} {$lote->sku} {$lote->cantidad}\n";
