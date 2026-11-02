<?php
// Ej1 — BUENA: cantidad PRIVADA + validación en el constructor; el estado nunca es imposible.
class Lote {
    public function __construct(private int $cantidad) {
        if ($cantidad < 0) { throw new \InvalidArgumentException("cantidad negativa"); }
    }
    public function cantidad(): int { return $this->cantidad; }
}
echo (new Lote(20))->cantidad() . "\n";
