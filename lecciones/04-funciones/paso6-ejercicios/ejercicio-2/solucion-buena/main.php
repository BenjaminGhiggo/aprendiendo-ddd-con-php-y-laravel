<?php
declare(strict_types=1);
// Ej2 — BUENA: la función DEVUELVE el resultado; quien llama decide qué hacer con él.
function suma(int $a, int $b): int { return $a + $b; }
$r = suma(2, 3);
echo ($r * 10) . "\n";  // 50: ahora sí puedo usar lo devuelto
