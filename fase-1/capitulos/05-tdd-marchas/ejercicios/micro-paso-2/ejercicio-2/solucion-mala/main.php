<?php
declare(strict_types=1);
// MALA: probar el caso de uso en marcha BAJA: el test arma todo el dominio a mano, repite detalle inutil.
final class Lote {
    public function __construct(public readonly string $ref, public readonly string $sku, public int $cant) {}
    public function asignar(int $n): void { $this->cant -= $n; }
}
$lote = new Lote("lote-1", "LAMPARA", 100);
$lote->asignar(10);                 // el test reimplementa el caso de uso paso a paso
echo ($lote->cant === 90 ? "lote-1" : "mal") . "\n";
