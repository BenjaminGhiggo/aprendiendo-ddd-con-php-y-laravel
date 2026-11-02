<?php
declare(strict_types=1);
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.
class SinStock extends \Exception {}

function asignar(int $cantidad, int $disponible): int
{
    if ($cantidad > $disponible) {
        throw new SinStock("sin stock: piden $cantidad y hay $disponible");
    }
    return $disponible - $cantidad;
}

echo asignar(2, 20) . "\n";   // 18
try {
    asignar(99, 20);
    echo "NO lanzó (mal)\n";
} catch (SinStock $e) {
    echo "SinStock atrapada\n";
}
