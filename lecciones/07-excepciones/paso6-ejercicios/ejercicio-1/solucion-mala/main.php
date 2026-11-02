<?php
declare(strict_types=1);
// Ej1 — MALA: cuando no hay stock, devuelve un número raro (-79) que el que llama puede no notar.
function asignar(int $cantidad, int $disponible): int {
    return $disponible - $cantidad;  // si piden de más, da negativo y nadie se entera
}
echo asignar(99, 20) . "\n";  // -79 (¿stock negativo?)
