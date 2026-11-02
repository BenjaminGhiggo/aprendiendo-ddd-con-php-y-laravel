<?php
// Ej2 — BUENA: carpeta temporal única del sistema; se borra al final (edge-to-edge limpio).
$dir = sys_get_temp_dir() . "/sync_" . uniqid();
mkdir($dir);
file_put_contents("$dir/x", "1");
echo file_get_contents("$dir/x") . "\n";   // 1
@unlink("$dir/x");
@rmdir($dir);                                // no deja rastro
echo "ok, sin basura\n";
