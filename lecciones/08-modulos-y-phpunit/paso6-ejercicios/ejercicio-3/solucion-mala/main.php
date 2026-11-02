<?php
declare(strict_types=1);
// Ej3 — MALA: comparar con == (débil): "5" (texto) y 5 (número) se dan por iguales sin querer.
$real = "5";       // viene como texto, por error
$esperado = 5;
echo ($esperado == $real ? "OK (pero oculta un bug de tipo)" : "FALLA") . "\n";
