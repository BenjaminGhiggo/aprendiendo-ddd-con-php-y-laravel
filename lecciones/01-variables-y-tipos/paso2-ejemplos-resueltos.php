<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 01.
// Ejecuta:  php lecciones/01-variables-y-tipos/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: saludar con un nombre variable (fácil) ---\n";
$nombre = "Ada";                       // Paso 1: guardar el dato en una variable
echo "Hola, $nombre\n";                // Paso 2: interpolar la variable  -> Hola, Ada
$nombre = "Grace";                     // Paso 3: cambiar el dato...
echo "Hola, $nombre\n";                // Paso 4: ...y el mensaje cambia solo -> Hola, Grace

echo "\n--- Ejemplo 2: el total de una compra (fácil) ---\n";
$precio = 100;                         // int
$cantidad = 3;                         // int
$total = $precio * $cantidad;          // una cuenta guardada en otra variable
echo "Total: $total\n";                 // -> 300

echo "\n--- Ejemplo 3: comprobar un tipo (intermedio) ---\n";
$qty = 20;                             // como el qty=20 del libro
echo "qty vale $qty y es de tipo " . gettype($qty) . "\n";   // integer
$sku = "SMALL-TABLE";
echo "sku vale $sku y es de tipo " . gettype($sku) . "\n";   // string

echo "\n--- Ejemplo 4: un mensaje como el del libro (avanzado) ---\n";
// El libro: f'Out of stock for {event.sku}'  (Cap. 8)
$eventoSku = "SMALL-TABLE";
echo "Out of stock for $eventoSku\n";  // interpolación (equivale a la f-string)
