<?php
// Ej2 — BUENA: readonly fija la identidad una sola vez; no se puede cambiar.
class Lote {
    public function __construct(public readonly string $referencia) {}
}
$l = new Lote("lote-001");
// $l->referencia = "lote-999"; // Error: Cannot modify readonly property
echo $l->referencia . "\n";
