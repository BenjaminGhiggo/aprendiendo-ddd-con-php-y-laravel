<?php
declare(strict_types=1);
// Ej3 — BUENA: un parámetro por defecto cubre los dos casos con una sola función.
function total(float $precio, float $factor = 1.0): float { return $precio * $factor; }
echo total(100) . "\n";       // sin iva
echo total(100, 1.18) . "\n"; // con iva
