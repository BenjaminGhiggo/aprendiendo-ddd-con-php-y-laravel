<?php
declare(strict_types=1);
// Ej1 — BUENA: el evento es una clase de datos inmutable (como dataclass frozen en Python).
abstract class Evento {}
final class SinStock extends Evento {
    public function __construct(public readonly string $sku) {}
}
$evento = new SinStock("MESA");
echo "SinStock del sku {$evento->sku}\n";
