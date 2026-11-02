<?php
// Ej1 — BUENA: cáscara imperativa = reunir (I/O) -> decidir (núcleo) -> aplicar (I/O).
function determinarAcciones(array $o, array $d): array {      // núcleo (datos->datos)
    $acc = [];
    foreach ($o as $n) { if (!in_array($n, $d, true)) { $acc[] = ['COPIAR', $n]; } }
    return $acc;
}
function nombres(string $carpeta): array {                    // I/O: reunir
    return array_values(array_filter(scandir($carpeta) ?: [], fn($n) => is_file("$carpeta/$n")));
}
function sincronizar(string $o, string $d): void {
    $acciones = determinarAcciones(nombres($o), nombres($d)); // reunir + decidir
    foreach ($acciones as $a) { if ($a[0] === 'COPIAR') { copy("$o/{$a[1]}", "$d/{$a[1]}"); } } // aplicar
}
echo "la cáscara solo orquesta; toda la lógica vive en el núcleo\n";
