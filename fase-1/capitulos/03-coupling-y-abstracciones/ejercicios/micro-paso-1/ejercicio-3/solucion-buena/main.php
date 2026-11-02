<?php
// Ej3 — BUENA: la lógica DEVUELVE las acciones; otro las ejecuta. Fácil de comprobar.
function decidir(array $origen, array $destino): array {
    $acciones = [];
    foreach ($origen as $n) {
        if (!in_array($n, $destino, true)) { $acciones[] = ['COPIAR', $n]; }
    }
    return $acciones;
}
$acciones = decidir(['a', 'b'], ['a']);
assert($acciones === [['COPIAR', 'b']]);   // se comprueba el resultado, no el efecto
echo "ok\n";
