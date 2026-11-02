<?php
// Ej2 — MALA (funciona): la referencia es pública y mutable; el "mismo" lote cambia de identidad.
class Lote { public string $referencia; }
$l = new Lote();
$l->referencia = "lote-001";
$l->referencia = "lote-999"; // ¡le cambiaron la identidad!
echo $l->referencia . "\n";
