<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 00. Los ejemplos del README (§9).
// Ejecuta:  php lecciones/00-que-es-ejecutar-un-programa/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: saludar (fácil) ---\n";
echo "Hola, mundo\n";                 // un solo echo con su texto y su \n

echo "\n--- Ejemplo 2: varias líneas (fácil) ---\n";
echo "Línea uno\n";                   // cada echo con su \n hace una línea
echo "Línea dos\n";

echo "\n--- Ejemplo 3: un cálculo (intermedio) ---\n";
echo "2 + 3 = ", 2 + 3, "\n";         // PHP calcula 2+3 y luego lo muestra

echo "\n--- Ejemplo 4: comentarios (avanzado) ---\n";
// Esta línea es un comentario: PHP la ignora por completo.
echo "Esto sí se ve\n";               // el comentario de aquí tampoco se ejecuta
/* Un bloque
   de varias líneas
   tampoco se ejecuta. */
echo "Y esto también\n";
