<?php
declare(strict_types=1);
// Ej2 — BUENA: la clave es SinStock::class (el FQN real); se busca con $e::class.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
$manejadores = [SinStock::class => fn(SinStock $e) => print("sin stock de {$e->sku}\n")];
$e = new SinStock("MESA");
($manejadores[$e::class])($e); // la clave sale del propio objeto
