<?php
declare(strict_types=1);
// paso3-tu-turno.php — PASO 3 de la Lección 07.
// Completa los // TODO. Luego: php lecciones/07-excepciones/paso3-tu-turno.php

// TODO 1: define una excepción propia class SinStock que extienda \Exception (cuerpo vacío {}).
class SinStock /* TODO: extends ... */ {
}

// TODO 2: completa asignar() para que LANCE SinStock si $cantidad > $disponible;
//         si no, devuelva $disponible - $cantidad.
function asignar(int $cantidad, int $disponible): int
{
    return 0; // <- cambia esto
}

// --- NO cambies lo de abajo ---
echo asignar(2, 20) . "\n";   // esperado: 18
try {
    asignar(99, 20);          // debe lanzar SinStock
    echo "NO lanzó (mal)\n";
} catch (SinStock $e) {
    echo "SinStock atrapada\n"; // esperado
}

// Salida esperada:
// 18
// SinStock atrapada
