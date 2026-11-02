<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 03.

echo "--- Ejemplo 1: saludar a muchos (fácil) ---\n";
$personas = ["Ada", "Grace", "Linus"];        // Paso 1: la lista
foreach ($personas as $persona) {             // Paso 2: una vuelta por cada una
    echo "Hola, $persona\n";                  // Paso 3: la acción repetida
}

echo "\n--- Ejemplo 2: sumar con un acumulador (fácil) ---\n";
$suma = 0;                                    // Paso 1: el acumulador empieza en 0
foreach ([10, 20, 30] as $n) {                // Paso 2: recorrer
    $suma = $suma + $n;                       // Paso 3: acumular
}
echo "Suma: $suma\n";                          // -> 60

echo "\n--- Ejemplo 3: contar con un contador (intermedio) ---\n";
$agotados = 0;
$stock = [10, 0, 4, 0];
foreach ($stock as $cantidad) {
    if ($cantidad === 0) { $agotados++; }     // contar los que están en 0
}
echo "Agotados: $agotados\n";                  // -> 2

echo "\n--- Ejemplo 4: el primero que cumple, con break (avanzado) ---\n";
// batch = next(b for b in sorted(batches) if b.can_allocate(line))  (Cap. 1)
$lotes = [["lote-a", 5], ["lote-b", 100], ["lote-c", 50]];
$pedido = 10;
$elegido = "ninguno";
foreach ($lotes as $lote) {
    if ($lote[1] >= $pedido) { $elegido = $lote[0]; break; }   // el PRIMERO que puede
}
echo "Elegido: $elegido\n";                    // -> lote-b
