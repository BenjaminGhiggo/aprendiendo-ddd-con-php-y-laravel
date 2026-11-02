<?php
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.

// TODO 1
$producto = "silla";
echo "Producto: $producto\n";

// TODO 2
$precio = 50;
$cantidad = 4;
$total = $precio * $cantidad;
echo "Total: $total\n";

// TODO 3
echo "Tipo: " . gettype($precio) . "\n";

// TODO 4
$sku = "LAMPARA";
echo "Out of stock for $sku\n";

// Salida esperada:
// Producto: silla
// Total: 200
// Tipo: integer
// Out of stock for LAMPARA
