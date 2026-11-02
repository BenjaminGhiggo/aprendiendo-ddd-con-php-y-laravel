<?php
// Ej2 — MALA: la hija reescribe toda la lógica de la madre en vez de reutilizarla.
class Empleado { public function __construct(protected int $base) {} }
class Gerente extends Empleado {
    public function __construct(int $base, private int $bono) { parent::__construct($base); }
    public function salario(): int { return $this->base + $this->bono; } // copia la fórmula de la madre
}
echo (new Gerente(1000, 500))->salario() . "\n";
