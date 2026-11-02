<?php
declare(strict_types=1);
// Ej3 — BUENA: el valor es una LISTA de manejadores; el foreach llama a todos.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
$manejadores = [SinStock::class => [
    fn(SinStock $e) => print("email: {$e->sku}\n"),
    fn(SinStock $e) => print("log: {$e->sku}\n"),
]];
$e = new SinStock("MESA");
foreach ($manejadores[$e::class] ?? [] as $m) { $m($e); }
