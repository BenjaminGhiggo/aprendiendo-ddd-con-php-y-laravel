<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia.
declare(strict_types=1);

interface Figura {
    public function area(): float;
}

class Rectangulo implements Figura {
    public function __construct(private float $base, private float $altura) {}
    public function area(): float { return $this->base * $this->altura; }
}

class Triangulo implements Figura {
    public function __construct(private float $base, private float $altura) {}
    public function area(): float { return ($this->base * $this->altura) / 2; }
}

function areaTotal(array $figuras): float {
    $total = 0.0;
    foreach ($figuras as $figura) {
        $total += $figura->area();
    }
    return $total;
}
