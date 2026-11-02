<?php
// Ej2 — MALA: la función lee el disco por dentro, así que el test necesita archivos reales.
function hayQueBorrar(string $destino, array $origen): array {
    $borrar = [];
    foreach (scandir($destino) ?: [] as $n) {                // I/O escondido
        if (is_file("$destino/$n") && !in_array($n, $origen, true)) { $borrar[] = $n; }
    }
    return $borrar;
}
echo "necesita una carpeta 'destino' de verdad para probarse...\n";
