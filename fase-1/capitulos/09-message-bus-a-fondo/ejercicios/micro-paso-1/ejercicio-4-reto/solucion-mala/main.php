<?php
declare(strict_types=1);
// Ej4 RETO — MALA: cuenta solo los mensajes iniciales; ignora la cascada.
$iniciales = ["A"];
$cola = $iniciales;
while ($cola !== []) {
    $m = array_shift($cola);
    if ($m === "A") { $cola[] = "B"; }
}
echo "procesados (mal): " . count($iniciales) . "\n"; // dice 1, pero fueron 2
