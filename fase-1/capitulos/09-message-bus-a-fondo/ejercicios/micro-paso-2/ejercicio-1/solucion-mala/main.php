<?php
declare(strict_types=1);
// Ej1 — MALA: bajar la cantidad deja el lote con disponible negativo. Inconsistente.
$comprada = 50;
$asignado = 50;
$comprada = 30;              // nuevo requisito
$disponible = $comprada - $asignado;
echo "disponible: $disponible\n"; // -20 : el lote promete mas de lo que tiene
