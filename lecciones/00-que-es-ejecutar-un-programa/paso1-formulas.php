<?php
// paso1-formulas.php — PASO 1 de la Lección 00.
// Cada bloque es una "fórmula" de las tablas del README (§6), con su código (P1, P2...).
// Ejecuta:  php lecciones/00-que-es-ejecutar-un-programa/paso1-formulas.php

// P1 · Mostrar un texto: echo + comillas + punto y coma al final.
echo "Hola, mundo\n";                 // -> Hola, mundo

// P2 · Mostrar un número (sin comillas).
echo 42;
echo "\n";                            // "\n" es un salto de línea

// P3 · Varias cosas en una línea con comas.
echo "dos", " ", "más", " ", "tres", "\n";   // -> dos más tres

// P4 · Unir texto con el punto (.) — el "pegamento" de strings en PHP.
echo "Hola" . " " . "mundo" . "\n";   // -> Hola mundo

// P5 · Un comentario de una línea empieza con // y PHP lo IGNORA.
echo "visible\n";   // esto de aquí no se ejecuta

/* P6 · Un comentario de varias
   líneas va entre barra-asterisco. */
echo "después del comentario\n";

// P7 · Una operación matemática se calcula antes de mostrarse.
echo 2 + 3, "\n";                     // -> 5

// P8 · print es parecido a echo (devuelve 1; echo no devuelve nada).
print "con print\n";                  // -> con print

// P9 · PHP_EOL es el salto de línea "del sistema" (equivale a "\n" en Linux).
echo "fin de línea portable" . PHP_EOL;
