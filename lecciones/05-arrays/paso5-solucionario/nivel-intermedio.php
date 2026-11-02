<?php
// nivel-intermedio.php — soluciones 🟡 5–8 (README §10).
$precios = ["pan" => 1, "leche" => 4];
$precios["pan"] = 2;      // la clave ya existe -> CAMBIA
$precios["huevo"] = 6;    // la clave no existe -> AGREGA
echo "P5: " . json_encode($precios) . "\n";
echo "P6:\n";
foreach ($precios as $producto => $precio) { echo "$producto cuesta $precio\n"; }
$notas = [12, 15, 9, 18];
$suma = 0;                // acumulador
foreach ($notas as $nota) { $suma = $suma + $nota; }
$promedio = $suma / count($notas);
echo "P7: suma $suma | promedio $promedio\n";   // 54 | 13.5
if (!array_key_exists("queso", $precios)) { echo "P8: no hay queso\n"; }
