<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.
declare(strict_types=1);

class LoteSeguro {
    private int $cantidad;

    public function __construct(int $cantidad) {
        if ($cantidad < 0) {
            throw new \InvalidArgumentException("cantidad negativa");
        }
        $this->cantidad = $cantidad;
    }

    public function disponible(): int {
        return $this->cantidad;
    }

    public function asignar(int $n): void {
        if ($n > $this->cantidad) {
            throw new \DomainException("sin stock");
        }
        $this->cantidad -= $n;
    }
}
