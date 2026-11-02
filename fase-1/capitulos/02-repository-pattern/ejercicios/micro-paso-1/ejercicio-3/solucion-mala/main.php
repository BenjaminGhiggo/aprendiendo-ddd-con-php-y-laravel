<?php
// Ej3 — MALA: obtener() revienta si no existe; el que llama no lo espera.
final class RepositorioFalso {
    public function __construct(private array $stock) {}
    public function obtener(string $ref): int { return $this->stock[$ref]; } // Warning + TypeError si falta
}
$repo = new RepositorioFalso(["lote-1" => 20]);
echo $repo->obtener("lote-1") . "\n";
