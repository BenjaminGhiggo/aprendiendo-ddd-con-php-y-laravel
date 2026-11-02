<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.

// TODO 1
$temp = 30;
if ($temp > 25) { echo "hace calor\n"; } else { echo "está fresco\n"; }

// TODO 2
$nota = 8;
if ($nota >= 18) { echo "excelente\n"; }
elseif ($nota >= 11) { echo "aprobado\n"; }
else { echo "desaprobado\n"; }

// TODO 3
$sku = "MESA"; $disponible = 5; $pedido = 10;
$puede = $sku === "MESA" && $disponible >= $pedido;
var_export($puede); echo "\n";

// Salida esperada:
// hace calor
// desaprobado
// false
