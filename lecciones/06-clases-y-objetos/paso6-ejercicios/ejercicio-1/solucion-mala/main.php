<?php
// Ej1 — MALA: datos sueltos en variables paralelas; nada los une.
$referencia = "lote-001";
$sku = "MESA";
$comprado = 20;
// si manejas 10 lotes, son 30 variables sueltas sin relación
echo "$referencia $sku $comprado\n";
