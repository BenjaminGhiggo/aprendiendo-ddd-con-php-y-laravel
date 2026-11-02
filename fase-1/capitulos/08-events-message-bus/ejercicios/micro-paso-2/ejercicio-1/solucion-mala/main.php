<?php
declare(strict_types=1);
// Ej1 — MALA: escalera de if por tipo de evento. Cada evento nuevo la alarga.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
function manejar(Evento $e): void {
    if ($e instanceof SinStock) {
        echo "notificar sin stock de {$e->sku}\n";
    } // elseif ($e instanceof Asignado) { ... }  <- hay que tocar esto siempre
}
manejar(new SinStock("MESA"));
