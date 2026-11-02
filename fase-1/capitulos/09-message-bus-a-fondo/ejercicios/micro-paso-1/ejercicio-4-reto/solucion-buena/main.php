<?php
declare(strict_types=1);
// Ej4 RETO — BUENA: cuenta cada mensaje sacado de la cola, incluida la cascada.
$cola = ["A"];
$procesados = 0;
while ($cola !== []) {
    $m = array_shift($cola);
    $procesados++;
    if ($m === "A") { $cola[] = "B"; }
}
echo "procesados (bien): $procesados\n"; // 2: A y B
