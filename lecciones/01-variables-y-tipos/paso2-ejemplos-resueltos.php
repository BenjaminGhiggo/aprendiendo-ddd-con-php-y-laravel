<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 01.
// Ejecuta:  php lecciones/01-variables-y-tipos/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: saludar con un nombre variable (fácil) ---\n";
$nombre = "Ada";                       // Paso 1: guardar el dato en una variable
echo "Hola, $nombre\n";                // Paso 2: interpolar dentro de comillas dobles -> Hola, Ada
$nombre = "Grace";                     // Paso 3: reasignar en UN solo lugar
echo "Hola, $nombre\n";                // Paso 4: el mensaje cambia solo -> Hola, Grace

echo "\n--- Ejemplo 2: el total de una compra (fácil) ---\n";
$precio = 100;                         // Paso 1: datos en variables
$cantidad = 3;
$total = $precio * $cantidad;          // Paso 2: guardar el resultado de una cuenta
echo "Total: $total\n";                 // -> Total: 300

echo "\n--- Ejemplo 3: unir texto y número (intermedio) ---\n";
$edad = 25;                            // Paso 1: $edad es un int
echo gettype($edad) . "\n";            // -> integer
$texto = "Tienes " . $edad . " años";  // Paso 2: el punto (.) une texto y número
echo $texto . "\n";                    // -> Tienes 25 años
echo "Tienes $edad años\n";            // Paso 3: lo mismo, interpolando

echo "\n--- Ejemplo 4: stock disponible de un lote, como en el libro (avanzado) ---\n";
$comprado = 20;                        // Paso 1: el lote compró 20 unidades
$asignado = 0;                         // Paso 2: todavía no se asignó nada
$asignado = $asignado + 2;             // Paso 3: llega una línea de pedido de 2
$disponible = $comprado - $asignado;   // Paso 4: disponible = comprado - asignado
echo "Disponible: $disponible\n";      // -> 18
$asignado = $asignado + 5;             // Paso 5: llega otra línea de 5
$disponible = $comprado - $asignado;   // Paso 6: hay que RECALCULAR
echo "Disponible: $disponible\n";      // -> 13
echo "Out of stock for SMALL-TABLE\n"; // puente: la f-string del cap. 8
