<?php
declare(strict_types=1);
// MALA: el controlador CREA sus dependencias dentro; queda atado a una implementacion concreta.
final class RepositorioEloquent { public function listar(): array { return ["lote-1"]; } }
final class AsignarController {
    public function asignar(): string {
        $repo = new RepositorioEloquent();   // acoplado: no puedo meter un falso en el test
        return $repo->listar()[0];
    }
}
echo (new AsignarController())->asignar() . "\n";
