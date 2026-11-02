<?php
declare(strict_types=1);
// Ej1 — BUENA: una aserción comprueba SOLA; si falla, avisa. (En PHPUnit: $this->assertSame.)
function doble(int $n): int { return $n * 2; }
$esperado = 10;
$real = doble(5);
echo ($esperado === $real ? "OK" : "FALLA: esperaba $esperado, obtuve $real") . "\n";
