<?php
declare(strict_types=1);
// Ej1 — BUENA: una cola. Lo que genera un handler vuelve a la cola (cascada).
$cola = ["A"];
while ($cola !== []) {
    $m = array_shift($cola);
    echo "proceso $m\n";
    if ($m === "A") { $cola[] = "B"; } // B se encola y SÍ se procesa
}
