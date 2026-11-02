<?php
// nivel-basico.php — soluciones de los problemas 🟢 1–4 (README §10).
// Ejecuta:  php lecciones/05-arrays/paso5-solucionario/nivel-basico.php
$colores = ["rojo", "verde", "azul"];
echo "P1: " . $colores[1] . "\n";                                 // verde
echo "P2: " . $colores[array_key_last($colores)] . "\n";          // azul
$colores[] = "negro";
echo "P3: " . count($colores) . "\n";                             // 4
$precios = ["pan" => 1, "leche" => 4];
echo "P4: " . $precios["leche"] . "\n";                           // 4
