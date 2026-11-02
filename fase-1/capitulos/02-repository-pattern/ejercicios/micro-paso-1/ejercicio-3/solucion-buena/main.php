<?php
// Ej3 — BUENA: obtener() devuelve null si no existe (?int); el que llama decide qué hacer.
final class RepositorioFalso {
    public function __construct(private array $stock) {}
    public function obtener(string $ref): ?int { return $this->stock[$ref] ?? null; }
}
$repo = new RepositorioFalso(["lote-1" => 20]);
echo var_export($repo->obtener("no-existe"), true) . "\n"; // NULL
