<?php
declare(strict_types=1);
// Ej1 — MALA: un solo tipo con un campo "tipo"; orden y hecho se confunden.
final class Mensaje {
    public function __construct(public readonly string $tipo, public readonly string $sku) {}
}
$a = new Mensaje("asignar", "MESA");   // orden?
$b = new Mensaje("asignado", "MESA");  // hecho? mismo tipo de objeto
echo "{$a->tipo} / {$b->tipo}\n";
