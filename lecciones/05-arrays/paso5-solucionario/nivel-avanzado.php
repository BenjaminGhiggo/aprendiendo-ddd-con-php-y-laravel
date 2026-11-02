<?php
// nivel-avanzado.php — soluciones 🔴 9–12 (README §10).
$palabras = ["mesa", "silla", "mesa", "cama", "mesa"];
$conteo = [];
foreach ($palabras as $palabra) { $conteo[$palabra] = ($conteo[$palabra] ?? 0) + 1; }
echo "P9: " . json_encode($conteo) . "\n";       // {"mesa":3,"silla":1,"cama":1}
$stock = ["mesa" => 10, "silla" => 0, "cama" => 4];
$agotados = [];
foreach ($stock as $producto => $cantidad) { if ($cantidad === 0) { $agotados[] = $producto; } }
echo "P10: " . json_encode($agotados) . "\n";    // ["silla"]
echo "P11: " . ($stock["sofá"] ?? 0) . "\n";      // 0
// P12 (puente al libro): array clave=>lista de funciones, como HANDLERS del cap. 8.
$registrar = function (string $pedido): void { echo "P12: registrado el pedido $pedido\n"; };
$avisar = function (string $pedido): void { echo "P12: avisado el cliente del pedido $pedido\n"; };
$manejadores = ["Asignado" => [$registrar, $avisar]];
foreach ($manejadores["Asignado"] as $funcion) { $funcion("o1"); }
