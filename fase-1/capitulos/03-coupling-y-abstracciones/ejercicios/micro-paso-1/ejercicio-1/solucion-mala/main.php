<?php
// Ej1 — MALA: decidir qué copiar está mezclado con leer y escribir el disco.
function sincronizarTodo(string $origen, string $destino): void {
    foreach (scandir($origen) ?: [] as $n) {                 // I/O
        if (is_file("$origen/$n") && !file_exists("$destino/$n")) {
            copy("$origen/$n", "$destino/$n");               // I/O + decisión, todo junto
        }
    }
}
echo "para probar esto hay que crear archivos reales en cada test...\n";
