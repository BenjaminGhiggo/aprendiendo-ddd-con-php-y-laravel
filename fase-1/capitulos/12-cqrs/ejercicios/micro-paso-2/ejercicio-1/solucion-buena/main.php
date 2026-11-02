<?php
// BUENA: una tabla desnormalizada; leer es un filtro simple por clave.
$vista = [["id" => "o1", "sku" => "MESA", "ref" => "l1"]];
$r = array_values(array_filter($vista, fn($f) => $f["id"] === "o1"));
print_r($r);
