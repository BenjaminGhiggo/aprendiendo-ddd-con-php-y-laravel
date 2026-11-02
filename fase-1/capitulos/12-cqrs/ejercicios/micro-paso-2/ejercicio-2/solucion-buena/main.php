<?php
// BUENA: un handler escucha Asignado y mantiene la vista. Un solo lugar, siempre consistente.
$vista = [];
$alAsignado = function(array $ev) use (&$vista) { $vista[] = ["id" => $ev["id"], "sku" => $ev["sku"], "ref" => $ev["ref"]]; };
$alAsignado(["id" => "o1", "sku" => "MESA", "ref" => "l1"]); // disparado por el dominio
echo count($vista) . " fila\n";
