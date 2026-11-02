<?php
declare(strict_types=1);
// Ej3 — MALA: el mapa guarda UN solo manejador; no hay sitio para una segunda reaccion.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
$manejadores = [SinStock::class => fn(SinStock $e) => print("email: {$e->sku}\n")];
$e = new SinStock("MESA");
($manejadores[$e::class])($e); // solo uno
