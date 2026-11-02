<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 05.
// Los 4 ejemplos resueltos del README (§9), en el mismo orden y con los mismos pasos.
// Ejecuta:  php lecciones/05-arrays/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: inventario con array (fácil) ---\n";
$productos = ["mesa", "silla", "lámpara"];       // Paso 1: crear (A1)
echo $productos[0] . "\n";                        // Paso 2: el primero (A3)  -> mesa
echo $productos[array_key_last($productos)] . "\n"; // Paso 3: el último (A4) -> lámpara
$productos[1] = "sofá";                            // Paso 4: cambiar (A5)
foreach ($productos as $prod) {                   // Paso 5: recorrer (A14)
    echo "$prod\n";                               // -> mesa / sofá / lámpara
}

echo "\n--- Ejemplo 2: registrar una venta (fácil) ---\n";
$stock = ["mesa" => 10, "silla" => 25];           // Paso 1: crear (O1)
$vendidas = 3;                                    // Paso 2: el dato de la venta
$stock["mesa"] = $stock["mesa"] - $vendidas;      // Paso 3: leer (O2), restar y guardar (O5)
echo $stock["mesa"] . "\n";                        // -> 7

echo "\n--- Ejemplo 3: contar repeticiones (intermedio) ---\n";
$pedidos = ["mesa", "silla", "mesa"];
$conteo = [];                                     // Paso 1: array vacío (A2)
foreach ($pedidos as $prod) {                     // Paso 2: recorrer (A14)
    $conteo[$prod] = ($conteo[$prod] ?? 0) + 1;   // Paso 3: leer seguro (O4) y sumar 1
    echo "  vuelta: $prod -> " . json_encode($conteo) . "\n";
}
echo json_encode($conteo) . "\n";                 // -> {"mesa":2,"silla":1}

echo "\n--- Ejemplo 4: array de evento -> funciones, como HANDLERS del libro (avanzado) ---\n";
$avisarEmail = function (string $sku): void { echo "EMAIL: sin stock de $sku\n"; };
$avisarSms = function (string $sku): void { echo "SMS: sin stock de $sku\n"; };
// Paso 1: clave (el nombre del evento) -> array de funciones.
$manejadores = ["SinStock" => [$avisarEmail, $avisarSms]];
foreach ($manejadores["SinStock"] as $funcion) {  // Paso 2: leer el array (O2) y recorrerlo (A14)
    $funcion("MESA");                             // Paso 3: llamar a cada una
}
