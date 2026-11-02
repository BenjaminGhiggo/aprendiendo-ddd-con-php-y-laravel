<?php
declare(strict_types=1);
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 08.
// Muestra los conceptos; los tests de verdad se corren con PHPUnit (§14).

echo "--- Ejemplo 1: importar un módulo (fácil) ---\n";
require_once __DIR__ . '/Tienda.php';           // trae la clase Tienda de otro archivo
$tienda = new Tienda(["MESA" => 20]);
echo "disponible MESA: " . $tienda->disponible("MESA") . "\n"; // 20

echo "\n--- Ejemplo 2: require_once no recarga (fácil) ---\n";
require_once __DIR__ . '/Tienda.php';           // segunda vez: 'once' la ignora (no hay error)
echo "no hubo error de redeclaración\n";

echo "\n--- Ejemplo 3: la idea de una aserción (intermedio) ---\n";
// En PHPUnit: $this->assertSame(18, $tienda->asignar("MESA", 2));
$resultado = $tienda->asignar("MESA", 2);
echo ($resultado === 18 ? "OK" : "FALLA") . ": asignar devolvió $resultado\n";

echo "\n--- Ejemplo 4: probar que algo LANZA (avanzado) ---\n";
// En PHPUnit: $this->expectException(SinStockTienda::class); $tienda->asignar("MESA", 99);
try {
    $tienda->asignar("MESA", 999);
    echo "FALLA: no lanzó\n";
} catch (SinStockTienda $e) {
    echo "OK: lanzó SinStockTienda (" . $e->getMessage() . ")\n";
}
