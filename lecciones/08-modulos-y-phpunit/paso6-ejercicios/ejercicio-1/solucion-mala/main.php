<?php
declare(strict_types=1);
// Ej1 — MALA: "comprobar" el código mirando la salida a ojo cada vez.
function doble(int $n): int { return $n * 2; }
echo doble(5) . "\n";  // ¿salió 10? hay que mirarlo cada vez, y es fácil equivocarse
