<?php
declare(strict_types=1);
// Ej2 — BUENA: tras cada handler recolectamos y encolamos; la cascada fluye.
$cola = ["asignar"];
$acumulados = [];
while ($cola !== []) {
    $m = array_shift($cola);
    echo "handler: $m\n";
    if ($m === "asignar") { $acumulados[] = "asignado"; }
    // recolectar eventos nuevos y encolarlos AHORA:
    while ($acumulados !== []) { $cola[] = array_shift($acumulados); }
}
