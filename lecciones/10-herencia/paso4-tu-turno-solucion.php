<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia.
declare(strict_types=1);

class Empleado {
    public function __construct(protected int $salarioBase) {}
    public function salario(): int { return $this->salarioBase; }
}

class Gerente extends Empleado {
    public function __construct(int $salarioBase, private int $bono) {
        parent::__construct($salarioBase);
    }

    public function salario(): int {
        return parent::salario() + $this->bono;
    }
}
