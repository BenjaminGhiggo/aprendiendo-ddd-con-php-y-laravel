<?php
// Ej1 — MALA (funciona): la cantidad es pública; cualquiera la deja en un valor imposible.
class Lote { public int $cantidad; }
$l = new Lote();
$l->cantidad = -999;   // nada lo impide
echo $l->cantidad . "\n";
