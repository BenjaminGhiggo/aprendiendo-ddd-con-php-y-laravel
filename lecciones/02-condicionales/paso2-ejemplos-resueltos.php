<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 02.
// Ejecuta:  php lecciones/02-condicionales/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: mayor de edad (fácil) ---\n";
$edad = 20;                                   // Paso 1: el dato
if ($edad >= 18) {                            // Paso 2: la comparación da true o false
    echo "Puede pasar\n";                     // Paso 3: corre si es true
} else {
    echo "No puede pasar\n";                  //         corre si es false
}

echo "\n--- Ejemplo 2: clasificar una nota (intermedio) ---\n";
$nota = 14;                                   // Paso 1: el dato
if ($nota >= 18) {                            // Paso 2: ¿14 >= 18? false -> se salta
    echo "excelente\n";
} elseif ($nota >= 11) {                      // Paso 3: ¿14 >= 11? true -> entra aquí
    echo "aprobado\n";
} else {                                      // Paso 4: el else se salta
    echo "desaprobado\n";
}

echo "\n--- Ejemplo 3: devolver un booleano (intermedio) ---\n";
$edad2 = 15;                                  // Paso 1: el dato
$esMayor = $edad2 >= 18;                      // Paso 2: la comparación YA es true/false
var_export($esMayor);                         // Paso 3: ver el booleano -> false
echo "\n";

echo "\n--- Ejemplo 4: la regla del libro, puede_asignar (avanzado) ---\n";
// return self.sku == line.sku and self.available_quantity >= line.qty  (Cap. 1)
$loteSku = "RELOJ";                           // Paso 1: datos del lote
$disponible = 100;
$lineaSku = "RELOJ";                          // Paso 2: datos de la línea de pedido
$cantidad = 10;
$mismoSku = $loteSku === $lineaSku;           // Paso 3: primera regla -> true
$alcanza = $disponible >= $cantidad;          // Paso 4: segunda regla -> true
$puede = $mismoSku && $alcanza;               // Paso 5: el && une las DOS
var_export($puede);                           // -> true
echo "\n";
