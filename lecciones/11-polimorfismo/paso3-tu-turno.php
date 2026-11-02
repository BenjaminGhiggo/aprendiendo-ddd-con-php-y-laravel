<?php
// paso3-tu-turno.php — PASO 3 de la Lección 11. Completa los // TODO.
// Comprobar: vendor/bin/phpunit lecciones/11-polimorfismo
declare(strict_types=1);

interface Figura {
    public function area(): float;
}

class Rectangulo implements Figura {
    public function __construct(private float $base, private float $altura) {}
    public function area(): float {
        // TODO 1: devuelve base * altura.
        throw new \Exception("TODO: completa area() de Rectangulo");
    }
}

class Triangulo implements Figura {
    public function __construct(private float $base, private float $altura) {}
    public function area(): float {
        // TODO 2: devuelve (base * altura) / 2.
        throw new \Exception("TODO: completa area() de Triangulo");
    }
}

// Suma el área de cualquier lista de figuras (sin saber de qué tipo son).
function areaTotal(array $figuras): float {
    // TODO 3: recorre $figuras con un foreach y suma el area() de cada una.
    throw new \Exception("TODO: completa areaTotal()");
}
