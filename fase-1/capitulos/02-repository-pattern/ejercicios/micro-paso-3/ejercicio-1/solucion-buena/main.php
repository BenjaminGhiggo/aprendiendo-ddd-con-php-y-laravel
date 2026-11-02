<?php
// Ej1 — BUENA: el servicio recibe un RepositorioDeLotes; no sabe cuál es (puerto/adaptador).
interface RepositorioDeLotes { public function obtener(string $ref): ?int; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function obtener(string $ref): ?int { return 20; }
}
function servicio(RepositorioDeLotes $repo, string $ref): int { return $repo->obtener($ref) ?? 0; }
echo servicio(new RepositorioFalso(), "lote-1") . "\n";
