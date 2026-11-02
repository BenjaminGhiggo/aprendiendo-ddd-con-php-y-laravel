<?php
declare(strict_types=1);
// BUENA: el modelo solo tiene la regla; un SERVICIO orquesta (traer, llamar al dominio).
final class Lote {
    public function __construct(public readonly string $referencia) {}
}
function asignar(Lote $linea, array $lotes): string {   // regla de dominio pura
    return $lotes[0]->referencia;
}
function servicioAsignar(Lote $linea, array $repo): string {  // orquesta
    $lotes = $repo;                     // 1. traer
    return asignar($linea, $lotes);     // 2. llamar al dominio
}
$lotes = [new Lote("lote-1")];
echo servicioAsignar(new Lote("x"), $lotes) . "\n";
