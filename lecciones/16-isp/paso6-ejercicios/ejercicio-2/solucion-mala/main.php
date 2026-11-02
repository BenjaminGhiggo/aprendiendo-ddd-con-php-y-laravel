<?php
// Ej2 — MALA (funciona): un reporte recibe un repo completo pero solo lee.
final class Repositorio {
    private array $datos = ["L1" => "Lote 1"];
    public function agregar(string $ref, string $valor): void { $this->datos[$ref] = $valor; }
    public function borrar(string $ref): void { unset($this->datos[$ref]); }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
function reporte(Repositorio $repo): string {
    // solo necesita obtener(), pero depende de TODO el repo (agregar, borrar...)
    return "Reporte: " . $repo->obtener("L1");
}
echo reporte(new Repositorio()) . "\n";
