<?php
// paso1-formulas.php — PASO 1 de la Lección 01.
// Ejecuta:  php lecciones/01-variables-y-tipos/paso1-formulas.php

// V1 · Crear una variable: un nombre que empieza con $ , un =, y un valor.
$nombre = "Ada";
echo "V1  \$nombre: $nombre\n";

// V2 · Cambiar el valor de una variable (se puede, cuando quieras).
$nombre = "Grace";
echo "V2  cambiada: $nombre\n";

// V3 · Tipo texto (string).
$sku = "MESA-PEQUEÑA";
echo "V3  string: $sku\n";

// V4 · Tipo entero (int).
$cantidad = 20;
echo "V4  int: $cantidad\n";

// V5 · Tipo decimal (float).
$precio = 19.9;
echo "V5  float: $precio\n";

// V6 · Tipo booleano (bool): true o false.
$disponible = true;
echo "V6  bool (var_export): "; var_export($disponible); echo "\n";

// V7 · ¿De qué tipo es una variable? gettype().
echo "V7  gettype(\$cantidad): " . gettype($cantidad) . "\n";

// V8 · var_dump muestra el tipo Y el valor (útil para depurar).
echo "V8  var_dump(\$precio): "; var_dump($precio);

echo "\n--- cuentas (operadores) ---\n";
// T1..T7 · operadores aritméticos.
echo "T1  suma 2 + 3:        " . (2 + 3) . "\n";
echo "T2  resta 10 - 4:      " . (10 - 4) . "\n";
echo "T3  por 6 * 7:         " . (6 * 7) . "\n";
echo "T4  entre 7 / 2:       " . (7 / 2) . "\n";     // 3.5 (división normal)
echo "T5  entera intdiv(7,2):" . intdiv(7, 2) . "\n"; // 3 (sin decimales)
echo "T6  resto 7 % 2:       " . (7 % 2) . "\n";      // 1
echo "T7  potencia 2 ** 10:  " . (2 ** 10) . "\n";    // 1024

echo "\n--- unir texto y números ---\n";
// T8 · Interpolación: dentro de "comillas dobles", $variable se reemplaza por su valor.
$cliente = "Ada"; $compras = 3;
echo "T8  interpolación: $cliente hizo $compras compras\n";
// T9 · Con llaves {$...} cuando pega con otras letras o es más complejo.
echo "T9  con llaves: {$cliente}123\n";
// T10 · Concatenar con el punto (.) y convertir el número con "" automático.
echo "T10 concatenar: " . $cliente . " tiene " . $compras . " compras\n";
// T11 · El libro arma mensajes así (f-string de Python -> interpolación de PHP):
$sku2 = "MESA";
echo "T11 Out of stock for $sku2\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8). Con declare(strict_types=1) PHP es estricto con los tipos.
// Descomenta una línea en un archivo con strict_types para ver su TypeError.
// "hola" + 3;        // E3 -> TypeError: Unsupported operand types: string + int
// echo $noExiste;    // E4 -> Warning: Undefined variable $noExiste
// ---------------------------------------------------------------------------
