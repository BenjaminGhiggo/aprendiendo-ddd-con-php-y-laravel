<?php
// Ej2 — MALA: la función IMPRIME el resultado, así que no puedes reutilizarlo.
function suma(int $a, int $b): void { echo ($a + $b) . "\n"; }
suma(2, 3);          // imprime 5
// pero no puedo hacer "suma(2,3) * 10": no devuelve nada
