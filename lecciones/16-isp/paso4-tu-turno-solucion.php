<?php
// paso4-tu-turno-solucion.php — PASO 4 de la Lección 16: solución de referencia.
interface Lector { public function obtener(string $ref): ?string; }
interface Escritor { public function agregar(string $ref): void; }
function reporte(Lector $lector, string $ref): string { return "Encontrado: " . $lector->obtener($ref); }
function respaldo(Escritor $escritor, string $ref): string {
    $escritor->agregar($ref);                       // TODO 1
    return "respaldado: " . $ref;
}
final class SoloLectura implements Lector {
    public function obtener(string $ref): ?string { return "solo-lectura:" . $ref; }  // TODO 2
}
final class Repositorio implements Lector, Escritor {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }          // TODO 3
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; } // TODO 4
}
