<?php
// Ej3 — MALA (funciona): quien usa el lote tiene que acordarse de validar ANTES de restar.
class Lote { public int $disponible = 10; }
$l = new Lote();
$l->disponible -= 999; // nadie comprobó: queda negativo
echo $l->disponible . "\n";
