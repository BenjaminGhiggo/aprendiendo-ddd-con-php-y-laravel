<?php
// Ej2 — BUENA: la hija reutiliza el método de la madre con parent:: y le añade lo suyo.
class Empleado {
    public function __construct(protected int $base) {}
    public function salario(): int { return $this->base; }
}
class Gerente extends Empleado {
    public function __construct(int $base, private int $bono) { parent::__construct($base); }
    public function salario(): int { return parent::salario() + $this->bono; }
}
echo (new Gerente(1000, 500))->salario() . "\n";
