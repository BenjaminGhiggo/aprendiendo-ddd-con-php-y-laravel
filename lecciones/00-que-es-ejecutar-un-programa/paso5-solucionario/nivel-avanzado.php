<?php
// nivel-avanzado.php — problemas 🔴 9–12 (README §10).
// P9: cálculo con precedencia (primero *, luego +).
echo "P9: ", 2 + 3 * 4, "\n";                       // 14, no 20
// P10: una "factura" en varias líneas.
echo "P10:\n"; echo "Mesa: 100\n"; echo "Silla: 50\n"; echo "Total: ", 100 + 50, "\n";
// P11: un comentario que explica una línea.
echo "P11: ", 60 * 60, "\n";                        // segundos en una hora: 3600
// P12 (puente al libro): mostrar el mensaje "Out of stock for MESA" (como la f-string del cap. 8).
$sku = "MESA";
echo "P12: Out of stock for $sku\n";                // interpolación (a fondo en la Lección 01)
