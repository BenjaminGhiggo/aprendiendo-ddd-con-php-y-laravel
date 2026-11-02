<?php
declare(strict_types=1);
// MALA: TODO en marcha baja; un refactor interno del dominio rompe muchos tests aunque el comportamiento no cambie.
final class Lote {
    public function __construct(public readonly string $ref, public int $cantidadComprada) {}
    public function asignado(): int { return 0; }   // detalle interno que el test observa
}
$lote = new Lote("lote-1", 100);
// el test mira campos internos: si renombro cantidadComprada, se rompe
echo ($lote->cantidadComprada === 100 ? "OK" : "mal") . "\n";
