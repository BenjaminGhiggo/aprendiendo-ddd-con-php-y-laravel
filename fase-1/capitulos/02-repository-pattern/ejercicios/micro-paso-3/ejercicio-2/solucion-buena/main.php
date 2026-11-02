<?php
// Ej2 — BUENA: los dos implementan la misma interfaz; se intercambian sin tocar el que llama.
interface RepositorioDeLotes { public function obtener(string $r): ?int; }
final class RepoMemoria implements RepositorioDeLotes { public function obtener(string $r): ?int { return 20; } }
final class RepoBd implements RepositorioDeLotes { public function obtener(string $r): ?int { return 20; } }
function usar(RepositorioDeLotes $repo): int { return $repo->obtener("lote-1") ?? 0; }
echo usar(new RepoMemoria()) . "\n";
echo usar(new RepoBd()) . "\n"; // mismo código, otro adaptador
