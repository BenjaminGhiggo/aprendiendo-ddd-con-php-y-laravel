<?php
// Ej1 — BUENA: una interfaz; el servicio depende del contrato, no de la BD.
interface RepositorioDeLotes { public function obtener(string $ref): ?int; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function __construct(private array $stock) {}
    public function obtener(string $ref): ?int { return $this->stock[$ref] ?? null; }
}
$repo = new RepositorioFalso(["lote-1" => 20]);  // sin BD, para el test
echo $repo->obtener("lote-1") . "\n";
