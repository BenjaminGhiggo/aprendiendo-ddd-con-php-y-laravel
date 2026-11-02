<?php
declare(strict_types=1);
// Ej2 — MALA: los eventos nuevos se recogen al final; la cascada no ocurre.
$cola = ["asignar"];
$acumulados = [];
while ($cola !== []) {
    $m = array_shift($cola);
    echo "handler: $m\n";
    if ($m === "asignar") { $acumulados[] = "asignado"; } // se guarda, no se encola aun
}
echo "recogidos al final (ya tarde): " . implode(",", $acumulados) . "\n";
