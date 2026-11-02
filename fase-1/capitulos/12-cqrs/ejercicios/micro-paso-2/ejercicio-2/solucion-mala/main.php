<?php
// MALA: el controlador se acuerda de actualizar la vista; si olvidas un sitio, queda vieja.
$vista = [];
function asignar(array &$vista, string $id, string $sku, string $ref): void { /* escribe modelo */ $vista[] = compact("id","sku","ref"); }
asignar($vista, "o1", "MESA", "l1");
echo count($vista) . " fila\n";
