<?php
// Ej2 — BUENA: el reporte depende solo de una interfaz pequeña de lectura.
interface Lector { public function obtener(string $ref): ?string; }
final class Repositorio implements Lector {
    private array $datos = ["L1" => "Lote 1"];
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
function reporte(Lector $lector): string {
    return "Reporte: " . $lector->obtener("L1");
}
echo reporte(new Repositorio()) . "\n";
