<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 03.
// Ejecuta:  php lecciones/03-bucles/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: saludar a muchos (fácil) ---\n";
$personas = ["Ada", "Grace", "Linus"];        // Paso 1: los datos, en un array
foreach ($personas as $persona) {             // Paso 2: una vuelta por cada uno
    echo "Hola, $persona\n";                  // Paso 3: lo que se repite
}
echo "Fin\n";                                 // Paso 4: fuera del foreach -> corre UNA vez

echo "\n--- Ejemplo 2: sumar con un acumulador (fácil) ---\n";
$suma = 0;                                    // Paso 1: el acumulador empieza en 0, ANTES del bucle
foreach ([10, 20, 30] as $n) {                // Paso 2: recorrer
    $suma = $suma + $n;                       // Paso 3: acumular
}
echo "Suma: $suma\n";                          // -> 60

echo "\n--- Ejemplo 3: contar con un contador (intermedio) ---\n";
$agotados = 0;                                // Paso 1: el contador empieza en 0, ANTES del bucle
$stock = [10, 0, 4, 0];
foreach ($stock as $cantidad) {               // Paso 2: recorrer
    if ($cantidad === 0) {                    // Paso 3: contar solo los que están en 0
        $agotados++;
    }
}
echo "Agotados: $agotados\n";                  // -> 2

echo "\n--- Ejemplo 4: el primero que cumple, con break (avanzado) ---\n";
// batch = next(b for b in sorted(batches) if b.can_allocate(line))  (Cap. 1)
$lotes = [["lote-a", 5], ["lote-b", 100], ["lote-c", 50]];  // Paso 1: lotes en orden de preferencia
$pedido = 10;                                 // Paso 2: lo que pide la línea
$elegido = "ninguno";                         // Paso 3: aquí guardo el elegido
foreach ($lotes as $lote) {                   // Paso 4: recorrer en orden
    if ($lote[1] >= $pedido) {                // Paso 5: el PRIMERO que alcance...
        $elegido = $lote[0];
        break;                                // ...y dejo de buscar
    }
}
echo "Elegido: $elegido\n";                    // -> lote-b
