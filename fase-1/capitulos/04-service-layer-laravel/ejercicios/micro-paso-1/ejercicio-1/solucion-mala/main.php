<?php
declare(strict_types=1);
// MALA: el MODELO orquesta (busca en el repositorio y confirma). Mezcla reglas con coordinacion.
final class Lote {
    public function __construct(public readonly string $referencia) {}
    // El dominio NO deberia conocer el repositorio ni la sesion:
    public function asignarUsando(array $repo): string {
        $todos = $repo;                 // "traer" metido en el modelo
        return $todos[0]->referencia;   // y ademas coordina
    }
}
$lotes = [new Lote("lote-1")];
echo (new Lote("x"))->asignarUsando($lotes) . "\n";
