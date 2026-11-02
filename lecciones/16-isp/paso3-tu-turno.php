<?php
// paso3-tu-turno.php — PASO 3 de la Lección 16 (ISP · pair programming).
// Rojo → verde (TDD):  vendor/bin/phpunit lecciones/16-isp
// Meta: cada pieza depende SOLO de la interfaz pequeña que usa.

interface Lector {
    public function obtener(string $ref): ?string;
}
interface Escritor {
    public function agregar(string $ref): void;
}

function reporte(Lector $lector, string $ref): string {
    return "Encontrado: " . $lector->obtener($ref);
}

function respaldo(Escritor $escritor, string $ref): string {
    // TODO 1: llama a $escritor->agregar($ref) y devuelve "respaldado: " . $ref.
    //         (este cliente solo necesita ESCRIBIR: receta I4)
    throw new \Exception("TODO 1");
}

final class SoloLectura implements Lector {
    // Implementa SOLO Lector: no debe tener agregar().
    public function obtener(string $ref): ?string {
        // TODO 2: devuelve "solo-lectura:" seguido de $ref (sin espacio).
        throw new \Exception("TODO 2");
    }
}

final class Repositorio implements Lector, Escritor {
    // Cumple las DOS interfaces pequeñas (receta I3/I6).
    private array $datos = [];
    public function agregar(string $ref): void {
        // TODO 3: guarda $ref en $this->datos (clave y valor: $ref).
        throw new \Exception("TODO 3");
    }
    public function obtener(string $ref): ?string {
        // TODO 4: devuelve el valor guardado para $ref, o null si no está.
        throw new \Exception("TODO 4");
    }
}
