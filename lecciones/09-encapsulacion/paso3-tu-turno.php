<?php
// paso3-tu-turno.php — PASO 3 de la Lección 09 (pair programming).
// Completa los // TODO de la clase. Luego el test Paso3TuTurnoTest.php debe pasar de ROJO a VERDE.
// Comprobar:  vendor/bin/phpunit lecciones/09-encapsulacion
declare(strict_types=1);

// La clase LoteSeguro debe: guardar la cantidad PRIVADA, validar que no sea negativa,
// tener un getter disponible(), y un método asignar(int $n) que no baje de 0.
class LoteSeguro {
    private int $cantidad;

    public function __construct(int $cantidad) {
        // TODO 1: si $cantidad < 0, lanza new \InvalidArgumentException("cantidad negativa").
        // TODO 2: guarda $cantidad en $this->cantidad.
        throw new \Exception("TODO: completa el constructor");
    }

    public function disponible(): int {
        // TODO 3: devuelve la cantidad.
        throw new \Exception("TODO: completa disponible()");
    }

    public function asignar(int $n): void {
        // TODO 4: si $n > $this->cantidad, lanza new \DomainException("sin stock").
        // TODO 5: si no, réstale $n a la cantidad.
        throw new \Exception("TODO: completa asignar()");
    }
}
