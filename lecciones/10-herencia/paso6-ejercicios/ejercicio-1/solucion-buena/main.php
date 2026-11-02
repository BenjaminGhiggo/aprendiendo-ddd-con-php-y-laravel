<?php
// Ej1 — BUENA: hereda de Lote con extends y solo agrega lo nuevo (sin duplicar).
class Lote {
    public function __construct(public string $referencia, public int $cantidad) {}
    public function descripcion(): string { return "Lote {$this->referencia} ({$this->cantidad})"; }
}
class LoteRefrigerado extends Lote {
    public function __construct(string $ref, int $cant, public int $temperatura) { parent::__construct($ref, $cant); }
}
echo (new LoteRefrigerado("l2", 10, 4))->descripcion() . "\n";
