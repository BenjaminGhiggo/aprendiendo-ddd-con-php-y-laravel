<?php
// Ej3 — BUENA: el test usa el RepositorioFalso en memoria; sin BD, rápido y aislado.
interface RepositorioDeLotes { public function obtener(string $r): ?int; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function __construct(private array $stock) {}
    public function obtener(string $r): ?int { return $this->stock[$r] ?? null; }
}
$repo = new RepositorioFalso(["lote-1" => 20]);  // "la BD" del test, en memoria
assert($repo->obtener("lote-1") === 20);
echo "test pasó sin base de datos\n";
