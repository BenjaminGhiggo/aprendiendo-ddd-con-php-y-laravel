<?php
declare(strict_types=1);
// BUENA: un agregarLote(primitivos) prepara el escenario; el test no toca el constructor.
final class Lote {
    public function __construct(public readonly string $referencia, public readonly string $sku, public readonly int $cantidad) {}
}
function agregarLote(array &$repo, string $ref, string $sku, int $cantidad): void {
    $repo[] = new Lote($ref, $sku, $cantidad);   // el servicio conoce el constructor, el test no
}
$repo = [];
agregarLote($repo, "lote-1", "LAMPARA", 100);    // solo primitivos
echo $repo[0]->referencia . "\n";
