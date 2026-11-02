<?php
declare(strict_types=1);
// BUENA: un repositorio FALSO en memoria; el test corre sin BD, instantaneo.
interface RepositorioDeLotes { public function listar(): array; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function __construct(private array $lotes) {}
    public function listar(): array { return $this->lotes; }
}
function servicioAsignar(RepositorioDeLotes $repo): string {
    return $repo->listar()[0];
}
$repo = new RepositorioFalso(["lote-1"]);   // sin BD
echo servicioAsignar($repo) . "\n";
