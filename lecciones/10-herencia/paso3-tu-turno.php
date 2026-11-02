<?php
// paso3-tu-turno.php — PASO 3 de la Lección 10. Completa los // TODO.
// Comprobar: vendor/bin/phpunit lecciones/10-herencia
declare(strict_types=1);

class Empleado {
    public function __construct(protected int $salarioBase) {}
    public function salario(): int { return $this->salarioBase; }
}

// Gerente hereda de Empleado y suma un bono a su salario.
class Gerente extends Empleado {
    public function __construct(int $salarioBase, private int $bono) {
        // TODO 1: llama al constructor de la madre: parent::__construct($salarioBase).
        throw new \Exception("TODO: completa el constructor");
    }

    public function salario(): int {
        // TODO 2: devuelve parent::salario() MÁS $this->bono.
        throw new \Exception("TODO: completa salario()");
    }
}
