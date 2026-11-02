<?php
declare(strict_types=1);
// MALA: muchos tests conocen el constructor; el dominio esta "filtrado" por todo el suite.
final class Lote { public function __construct(public readonly string $ref, public readonly string $sku, public readonly int $cant) {} }
// test A
$a = new Lote("l1", "LAMPARA", 100);
// test B
$b = new Lote("l2", "MESA", 50);
// test C ... cada uno repite y conoce el constructor
echo $a->ref . " " . $b->ref . "\n";
