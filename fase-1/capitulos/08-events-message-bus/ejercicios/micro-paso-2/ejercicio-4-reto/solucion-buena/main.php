<?php
declare(strict_types=1);
// Ej4 RETO — BUENA: dos manejadores independientes en la lista; el bus llama a los dos.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
function enviarEmail(SinStock $e): void { echo "email: {$e->sku}\n"; }
function apuntarEnLog(SinStock $e): void { echo "log: {$e->sku}\n"; }
function manejadores(): array {
    return [SinStock::class => ['enviarEmail', 'apuntarEnLog']];
}
function manejar(Evento $e): void {
    foreach (manejadores()[$e::class] ?? [] as $m) { $m($e); }
}
manejar(new SinStock("MESA"));
