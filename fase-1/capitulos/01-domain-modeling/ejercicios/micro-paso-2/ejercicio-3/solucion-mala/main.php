<?php
// Ej3 — MALA: usar los objetos como valores de un array no deduplica por valor.
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$lista = [];
$lista[] = new LineaPedido("MESA", 2);
$lista[] = new LineaPedido("MESA", 2); // "la misma" línea
echo count($lista) . "\n"; // 2 (esperábamos 1)
