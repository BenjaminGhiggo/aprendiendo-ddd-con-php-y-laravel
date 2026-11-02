<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.
// Compárala con la tuya:
//   git diff --no-index lecciones/05-arrays/paso3-tu-turno.php lecciones/05-arrays/paso4-tu-turno-solucion.php

$productos = ["mesa", "silla", "lámpara"];

// TODO 1
echo $productos[array_key_last($productos)] . "\n";

// TODO 2
$productos[] = "cama";

// TODO 3
echo count($productos) . "\n";

$stock = ["mesa" => 10, "silla" => 25];

// TODO 4
$stock["cama"] = 4;

// TODO 5
$stock["silla"] = $stock["silla"] - 3;

// TODO 6
echo ($stock["sofá"] ?? 0) . "\n";

// TODO 7
foreach ($stock as $clave => $valor) {
    echo "$clave -> $valor\n";
}

// Salida esperada:
// lámpara
// 4
// 0
// mesa -> 10
// silla -> 22
// cama -> 4
