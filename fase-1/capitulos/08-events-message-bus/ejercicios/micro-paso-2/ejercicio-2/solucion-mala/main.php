<?php
declare(strict_types=1);
// Ej2 — MALA: la clave es un string literal "SinStock". Renombrar la clase lo rompe en silencio.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
$manejadores = ["SinStock" => fn(SinStock $e) => print("sin stock de {$e->sku}\n")];
$e = new SinStock("MESA");
$clave = "SinStock"; // a mano; el IDE no lo liga a la clase
($manejadores[$clave])($e);
