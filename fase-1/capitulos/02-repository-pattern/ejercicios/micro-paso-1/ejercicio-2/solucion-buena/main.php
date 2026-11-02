<?php
// Ej2 — BUENA: implements obliga a tener exactamente los métodos del contrato.
interface RepositorioDeLotes { public function obtener(string $ref): ?int; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function obtener(string $ref): ?int { return 20; }
}
$repo = new RepositorioFalso();
echo $repo->obtener("lote-1") . "\n";
