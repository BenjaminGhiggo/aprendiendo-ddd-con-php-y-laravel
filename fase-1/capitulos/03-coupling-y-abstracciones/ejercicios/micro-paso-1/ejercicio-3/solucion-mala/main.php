<?php
// Ej3 — MALA: la lógica ejecuta el efecto (echo/borrado) en el momento; no se puede inspeccionar.
function decidir(array $origen, array $destino): void {
    foreach ($origen as $n) {
        if (!in_array($n, $destino, true)) { echo "copiando $n\n"; } // efecto inmediato
    }
}
decidir(['a', 'b'], ['a']);  // ¿cómo compruebas QUÉ decidió sin leer la salida de texto?
