<?php
declare(strict_types=1);
// nivel-basico.php — problemas 🟢 1–4 (README §10).
function cuadrado(int $n): int { return $n * $n; }
echo "P1: " . cuadrado(6) . "\n";                       // 36
function saludar(string $nombre): string { return "Hola, $nombre"; }
echo "P2: " . saludar("Ana") . "\n";                    // Hola, Ana
function esMayor(int $a, int $b): bool { return $a > $b; }
echo "P3: " . var_export(esMayor(5, 3), true) . "\n";   // true
function conIva(float $precio): float { return $precio * 1.18; }
echo "P4: " . conIva(100) . "\n";                       // 118
