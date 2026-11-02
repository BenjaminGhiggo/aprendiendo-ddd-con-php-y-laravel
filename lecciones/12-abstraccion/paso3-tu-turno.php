<?php
// paso3-tu-turno.php — PASO 3 de la Lección 12. Completa los // TODO.
// Comprobar: vendor/bin/phpunit lecciones/12-abstraccion
declare(strict_types=1);

abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(int $i): string;

    // código compartido: usa los métodos abstractos (ya hecho, no lo toques).
    public function agregarVarios(array $referencias): void {
        foreach ($referencias as $ref) { $this->agregar($ref); }
    }
}

// Implementa un repositorio EN MEMORIA que cumpla el contrato de la abstracta.
class RepositorioMemoria extends RepositorioAbstracto {
    private array $lotes = [];

    public function agregar(string $ref): void {
        // TODO 1: agrega $ref al final de $this->lotes.
        throw new \Exception("TODO: completa agregar()");
    }

    public function obtener(int $i): string {
        // TODO 2: devuelve el elemento en la posición $i de $this->lotes.
        throw new \Exception("TODO: completa obtener()");
    }
}
