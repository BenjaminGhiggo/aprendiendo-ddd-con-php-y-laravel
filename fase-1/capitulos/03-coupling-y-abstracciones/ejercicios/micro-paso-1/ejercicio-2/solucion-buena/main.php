<?php
// Ej2 — BUENA: recibe los nombres como DATOS; decide sin leer el disco.
function hayQueBorrar(array $origen, array $destino): array {
    $borrar = [];
    foreach ($destino as $n) {
        if (!in_array($n, $origen, true)) { $borrar[] = $n; }
    }
    return $borrar;
}
print_r(hayQueBorrar(['a'], ['a', 'sobra']));   // ['sobra']
