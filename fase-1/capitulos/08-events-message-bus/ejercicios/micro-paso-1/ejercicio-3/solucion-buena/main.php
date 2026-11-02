<?php
declare(strict_types=1);
// Ej3 — BUENA: el evento es autosuficiente; lleva el sku dentro.
abstract class Evento {}
final class SinStock extends Evento {
    public function __construct(public readonly string $sku) {}
}
$e = new SinStock("MESA");
echo "sin stock de {$e->sku}\n";
