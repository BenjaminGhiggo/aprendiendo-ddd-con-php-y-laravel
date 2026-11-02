<?php
// Ej3 — BUENA: indexar por HASH del contenido; mismo contenido = misma clave (hay que MOVER, no copiar).
$dir = sys_get_temp_dir() . "/sync_" . uniqid();
mkdir($dir);
file_put_contents("$dir/foto.jpg", "pixels");
$hash = hash_file('sha1', "$dir/foto.jpg");
$indice = [$hash => 'foto.jpg'];     // hash => nombre
// si en destino el mismo hash aparece como 'imagen.jpg', sabemos que es un RENOMBRE
echo "hash: " . substr($hash, 0, 8) . " -> " . $indice[$hash] . "\n";
@unlink("$dir/foto.jpg"); @rmdir($dir);
