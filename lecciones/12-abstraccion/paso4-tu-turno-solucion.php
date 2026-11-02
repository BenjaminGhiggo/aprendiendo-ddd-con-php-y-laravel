<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia.
declare(strict_types=1);

abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(int $i): string;

    public function agregarVarios(array $referencias): void {
        foreach ($referencias as $ref) { $this->agregar($ref); }
    }
}

class RepositorioMemoria extends RepositorioAbstracto {
    private array $lotes = [];

    public function agregar(string $ref): void {
        $this->lotes[] = $ref;
    }

    public function obtener(int $i): string {
        return $this->lotes[$i];
    }
}
