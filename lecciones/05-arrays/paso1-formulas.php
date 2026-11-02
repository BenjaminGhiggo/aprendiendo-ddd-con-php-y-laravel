<?php
// paso1-formulas.php — PASO 1 de la Lección 05.
// Cada bloque es una "fórmula" de las tablas del README (§5 y §6), con su código (A1, O1...).
// Ejecuta:  php lecciones/05-arrays/paso1-formulas.php
// y compara cada línea impresa con la columna "Resultado" de la tabla.
//
// En PHP, UN SOLO tipo (array) sirve de lista Y de diccionario. Un array sin claves es una
// "lista" (índices 0,1,2...); un array con claves de texto es un "diccionario" (asociativo).

echo "========== ARRAYS INDEXADOS (lista) ==========\n";

// A1 · Crear: valores entre corchetes [ ], separados por comas.
$productos = ["mesa", "silla", "lámpara"];
echo "A1  crear:            " . json_encode($productos, JSON_UNESCAPED_UNICODE) . "\n";

// A2 · Array vacío.
$vacio = [];
echo "A2  vacío:            " . json_encode($vacio) . "\n";

// A3 · Acceder por posición (índice). El PRIMERO es el 0.
echo "A3  \$productos[0]:    " . $productos[0] . "\n";

// A4 · El último: array_key_last() da el último índice.
echo "A4  último:           " . $productos[array_key_last($productos)] . "\n";

// A5 · Cambiar el elemento de una posición.
$productos[1] = "sofá";
echo "A5  cambiar [1]:      " . json_encode($productos, JSON_UNESCAPED_UNICODE) . "\n";
$productos[1] = "silla"; // lo devolvemos

// A6 · Tamaño: cuántos elementos.
echo "A6  count:            " . count($productos) . "\n";

// A7 · Agregar al final: $array[] = valor.
$productos[] = "cama";
echo "A7  \$p[] = 'cama':    " . json_encode($productos, JSON_UNESCAPED_UNICODE) . "\n";

// A8 · ¿Está?
echo "A8  in_array('mesa'): " . var_export(in_array("mesa", $productos), true) . "\n";
echo "A8  in_array('sofá'): " . var_export(in_array("sofá", $productos), true) . "\n";

// A9 · ¿En qué posición está? (false si no está)
echo "A9  array_search:     " . var_export(array_search("silla", $productos), true) . "\n";

// A10 · Quitar el último: array_pop lo quita Y lo devuelve.
$ultimo = array_pop($productos);
echo "A10 array_pop:        devolvió '$ultimo', queda " . json_encode($productos, JSON_UNESCAPED_UNICODE) . "\n";

// A11 · Rebanar: array_slice(desde, cuántos). Devuelve una copia.
echo "A11 array_slice(0,2): " . json_encode(array_slice($productos, 0, 2), JSON_UNESCAPED_UNICODE) . "\n";

// A12 · Ordenar: sort() ordena EN EL SITIO (cambia el array) y devuelve true.
$copia = $productos;
sort($copia);
echo "A12 sort (copia):     " . json_encode($copia, JSON_UNESCAPED_UNICODE) . "\n";

// A13 · ¡OJO! sort() de números SÍ ordena como números (a diferencia de JavaScript).
$numeros = [10, 9, 100];
sort($numeros);
echo "A13 sort([10,9,100]): " . json_encode($numeros) . "\n";

// A14 · Recorrer: en cada vuelta, \$prod toma un elemento.
echo "A14 recorrer:\n";
foreach ($productos as $prod) {
    echo "      -> $prod\n";
}

echo "\n========== ARRAYS ASOCIATIVOS (diccionario) ==========\n";

// O1 · Crear: pares clave => valor.
$stock = ["mesa" => 10, "silla" => 25];
echo "O1  crear:            " . json_encode($stock) . "\n";

// O2 · Leer por clave.
echo "O2  \$stock['mesa']:   " . $stock["mesa"] . "\n";

// O4 · Leer seguro: ?? da el valor por defecto si la clave no existe (sin Warning).
echo "O4  ['cama'] ?? 0:    " . ($stock["cama"] ?? 0) . "\n";

// O5 · Agregar (si no existe) o cambiar (si ya existe).
$stock["cama"] = 4;
echo "O5  \$stock['cama']=4: " . json_encode($stock) . "\n";

// O6 · ¿Existe la clave? array_key_exists (o isset, que además exige que no sea null).
echo "O6  array_key_exists: " . var_export(array_key_exists("mesa", $stock), true) . "\n";

// O7 · Tamaño.
echo "O7  count:            " . count($stock) . "\n";

// O8 · Borrar un par.
unset($stock["cama"]);
echo "O8  unset('cama'):    " . json_encode($stock) . "\n";

// O9 · Claves y O10 valores.
echo "O9  array_keys:       " . json_encode(array_keys($stock)) . "\n";
echo "O10 array_values:     " . json_encode(array_values($stock)) . "\n";

// O11 · Recorrer pares: clave => valor.
echo "O11 recorrer pares:\n";
foreach ($stock as $clave => $valor) {
    echo "      -> $clave $valor\n";
}

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8).
// O3 · Leer una clave que NO existe: Warning "Undefined array key" y devuelve null.
echo "\nO3  leer clave inexistente (genera un Warning):\n";
echo "      \$stock['cama'] = ";
var_export(@$stock["cama"]); // la @ silencia el Warning solo para esta demo
echo " (es null)\n";
// E3 · count() de algo que no es array -> TypeError (descomenta para verlo):
// echo count(5);   // TypeError: count(): Argument #1 ($value) must be of type Countable|array, int given
// ---------------------------------------------------------------------------
