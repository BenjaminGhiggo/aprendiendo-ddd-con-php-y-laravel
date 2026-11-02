<?php
// Ej3 — MALA: compara solo por nombre; si el archivo se renombra, copia un duplicado.
function hashesPorNombre(array $nombres): array { return $nombres; } // ignora el contenido
$origen = ['foto.jpg'];
$destino = ['imagen.jpg'];          // mismo contenido, otro nombre
echo "cree que es nuevo y lo copia de nuevo (duplica)\n";
