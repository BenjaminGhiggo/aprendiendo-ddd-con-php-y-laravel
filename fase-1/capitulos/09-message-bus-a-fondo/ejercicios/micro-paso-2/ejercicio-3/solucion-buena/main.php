<?php
declare(strict_types=1);
// Ej3 — BUENA: solo emito AsignacionRequerida; el bus reasigna con el handler ya existente.
function cambiarCantidad(int $nueva, array $lineas): array {
    echo "bajo a $nueva y EMITO eventos:\n";
    $eventos = [];
    foreach ($lineas as $l) { $eventos[] = "AsignacionRequerida($l)"; }
    return $eventos;
}
$cola = cambiarCantidad(30, [50]);
while ($cola !== []) {
    $e = array_shift($cola);
    echo "  bus -> handler asignar procesa $e\n"; // reusa la misma logica de asignar
}
