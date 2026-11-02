<?php
declare(strict_types=1);
// BUENA: el repositorio llega por el CONSTRUCTOR (el contenedor de Laravel lo inyecta — cap. 13).
interface RepositorioDeLotes { public function listar(): array; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function listar(): array { return ["lote-1"]; }
}
final class AsignarController {
    public function __construct(private readonly RepositorioDeLotes $repo) {}
    public function asignar(): string { return $this->repo->listar()[0]; }
}
// En el test inyecto un falso; en produccion Laravel inyecta el Eloquent.
echo (new AsignarController(new RepositorioFalso()))->asignar() . "\n";
