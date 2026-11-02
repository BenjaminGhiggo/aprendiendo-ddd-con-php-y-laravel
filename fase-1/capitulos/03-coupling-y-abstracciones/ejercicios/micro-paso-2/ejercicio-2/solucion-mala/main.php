<?php
// Ej2 — MALA: el test crea archivos en una ruta fija dentro del proyecto y no limpia.
$dir = __DIR__ . "/basura";          // ensucia el repo; dos tests chocan
@mkdir($dir);
file_put_contents("$dir/x", "1");
echo "quedó basura en el repo y no se borra\n";
