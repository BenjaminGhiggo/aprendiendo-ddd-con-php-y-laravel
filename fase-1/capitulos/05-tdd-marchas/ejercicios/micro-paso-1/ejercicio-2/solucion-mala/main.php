<?php
declare(strict_types=1);
// MALA: el test arma el escenario con new Lote(...) a mano; acoplado al constructor del dominio.
final class Lote {
    public function __construct(public readonly string $referencia, public readonly string $sku, public readonly int $cantidad) {}
}
$repo = [];
$repo[] = new Lote("lote-1", "LAMPARA", 100);   // el test conoce el constructor
echo $repo[0]->referencia . "\n";
