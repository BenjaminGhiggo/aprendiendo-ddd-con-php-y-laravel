<?php
// Ej1 — BUENA: un núcleo que SOLO decide, a partir de datos; sin tocar el disco.
function determinarAcciones(array $origen, array $destino): array { // array de nombres
    $acciones = [];
    foreach ($origen as $n) {
        if (!in_array($n, $destino, true)) { $acciones[] = ['COPIAR', $n]; }
    }
    return $acciones;
}
// Se prueba con datos de entrada y de salida, sin ningún archivo:
print_r(determinarAcciones(['a', 'b'], ['a']));   // [['COPIAR','b']]
