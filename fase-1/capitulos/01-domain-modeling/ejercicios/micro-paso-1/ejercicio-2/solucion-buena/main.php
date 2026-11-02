<?php
// Ej2 — BUENA: nombres del lenguaje del negocio (regla 6).
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$linea = new LineaPedido("MESA", 2);
echo $linea->sku . " " . $linea->cantidad . "\n";
