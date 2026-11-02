<?php
// Ej1 — MALA: copia toda la clase Lote para hacer LoteRefrigerado (código duplicado).
class LoteRefrigerado {
    public function __construct(public string $referencia, public int $cantidad, public int $temperatura) {}
    public function descripcion(): string { return "Lote {$this->referencia} ({$this->cantidad})"; }
}
echo (new LoteRefrigerado("l2", 10, 4))->descripcion() . "\n";
