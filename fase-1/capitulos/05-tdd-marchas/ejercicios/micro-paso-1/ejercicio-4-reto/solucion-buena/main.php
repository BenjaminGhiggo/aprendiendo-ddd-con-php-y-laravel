<?php
declare(strict_types=1);
// BUENA: un solo helper de servicio conoce el constructor; los tests solo usan primitivos.
final class Lote { public function __construct(public readonly string $ref, public readonly string $sku, public readonly int $cant) {} }
function agregarLote(array &$repo, string $ref, string $sku, int $cant): void {
    $repo[] = new Lote($ref, $sku, $cant);   // UNICO punto que conoce el constructor
}
$repo = [];
agregarLote($repo, "l1", "LAMPARA", 100);    // test A: primitivos
agregarLote($repo, "l2", "MESA", 50);        // test B: primitivos
echo $repo[0]->ref . " " . $repo[1]->ref . "\n";
