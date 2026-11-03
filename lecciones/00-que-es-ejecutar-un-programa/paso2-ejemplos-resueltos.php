<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 00. Los ejemplos del README (§9).
// Ejecuta:  php lecciones/00-que-es-ejecutar-un-programa/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: saludar (fácil) ---\n";
echo "Hola, mundo\n";                 // Paso 1: un echo, su texto entre comillas y un \n

echo "\n--- Ejemplo 2: varias líneas (fácil) ---\n";
echo "Línea uno\n";                   // Paso 1: primer echo; el \n baja de línea
echo "Línea dos\n";                   // Paso 2: va DESPUÉS porque está abajo

echo "\n--- Ejemplo 3: un cálculo (intermedio) ---\n";
echo "2 + 3 = ", 2 + 3, "\n";         // tres valores por coma; PHP resuelve 2+3 ANTES de mostrar -> 5

echo "\n--- Ejemplo 4: comentarios (avanzado) ---\n";
// Paso 1: esta línea es un comentario de una línea: PHP la ignora por completo.
echo "Esto sí se ve\n";               // Paso 2: este echo SÍ se ejecuta
/* Paso 3: un bloque
   de varias líneas
   tampoco se ejecuta. */
echo "Y esto también\n";              // Paso 4: este echo también se ejecuta
