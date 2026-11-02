<?php
declare(strict_types=1);
// Ej3 — MALA: cambiarCantidad reasigna a mano; duplica la logica de asignar.
function cambiarCantidad(int $nueva, array $lineas): void {
    echo "bajo a $nueva y REASIGNO yo mismo:\n";
    foreach ($lineas as $l) { echo "  asignando $l a mano\n"; } // logica duplicada
}
cambiarCantidad(30, [50]);
