<?php
declare(strict_types=1);
// Ej3 — MALA: dos funciones casi iguales solo porque una tiene IVA y la otra no.
function total(float $precio): float { return $precio; }
function totalConIva(float $precio): float { return $precio * 1.18; }
echo total(100) . "\n";
echo totalConIva(100) . "\n";
