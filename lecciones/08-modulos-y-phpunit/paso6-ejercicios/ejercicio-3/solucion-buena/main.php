<?php
declare(strict_types=1);
// Ej3 — BUENA: comparar con === (estricto): distingue "5" de 5 y atrapa el bug de tipo.
$real = "5";
$esperado = 5;
echo ($esperado === $real ? "OK" : "FALLA: tipos distintos ('$real' no es $esperado)") . "\n";
