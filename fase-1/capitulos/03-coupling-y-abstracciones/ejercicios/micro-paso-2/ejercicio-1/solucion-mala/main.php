<?php
// Ej1 — MALA: la función de arriba mezcla reunir, decidir y aplicar en un solo bucle.
function sincronizar(string $o, string $d): void {
    foreach (scandir($o) ?: [] as $n) {
        if (is_file("$o/$n")) {
            if (!file_exists("$d/$n")) { copy("$o/$n", "$d/$n"); } // decidir + aplicar juntos
        }
    }
}
echo "lógica y I/O entrelazados; no se puede probar la decisión sola\n";
