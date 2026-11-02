<?php
// paso3-tu-turno.php — PASO 3 de la Lección 05 (pair programming).
// Completa cada // TODO escribiendo la línea DEBAJO del comentario. Luego ejecuta:
//   php lecciones/05-arrays/paso3-tu-turno.php
// y compara tu salida con la "Salida esperada" del final.
// Si te trabas, mira la fórmula indicada entre paréntesis en el README (§5 y §6).

// --- Parte A: array indexado ---
$productos = ["mesa", "silla", "lámpara"];

// TODO 1: imprime el ÚLTIMO producto usando array_key_last (fórmula A4), seguido de "\n".

// TODO 2: agrega "cama" al final del array (A7).

// TODO 3: imprime cuántos productos hay ahora (A6), seguido de "\n".

// --- Parte B: array asociativo ---
$stock = ["mesa" => 10, "silla" => 25];

// TODO 4: agrega "cama" con stock 4 (O5).

// TODO 5: se vendieron 3 sillas: réstalas del stock (lee con O2, guarda con O5).

// TODO 6: muestra el stock de "sofá"; si no existe, 0 (O4), seguido de "\n".

// TODO 7: recorre $stock e imprime "mesa -> 10", etc. (O11). Pista: "$clave -> $valor\n".

// Salida esperada:
// lámpara
// 4
// 0
// mesa -> 10
// silla -> 22
// cama -> 4
