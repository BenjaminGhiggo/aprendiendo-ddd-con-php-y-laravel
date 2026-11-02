<?php
// MALA: para mostrar asignaciones, recorro productos->lotes->asignaciones (muchos accesos).
$productos = [["lotes" => [["ref" => "l1", "lineas" => [["id" => "o1", "sku" => "MESA"]]]]]];
$filas = [];
foreach ($productos as $p) foreach ($p["lotes"] as $l) foreach ($l["lineas"] as $ln) $filas[] = [$ln["id"], $ln["sku"], $l["ref"]];
print_r($filas);
