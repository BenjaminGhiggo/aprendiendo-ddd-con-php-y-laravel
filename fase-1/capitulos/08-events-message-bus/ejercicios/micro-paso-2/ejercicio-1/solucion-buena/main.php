<?php
declare(strict_types=1);
// Ej1 — BUENA: un mapa tipo->manejadores; el foreach es generico.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
function notificarSinStock(SinStock $e): void { echo "notificar sin stock de {$e->sku}\n"; }
function manejadores(): array {
    return [SinStock::class => ['notificarSinStock']];
}
function manejar(Evento $e): void {
    foreach (manejadores()[$e::class] ?? [] as $manejador) { $manejador($e); }
}
manejar(new SinStock("MESA"));
