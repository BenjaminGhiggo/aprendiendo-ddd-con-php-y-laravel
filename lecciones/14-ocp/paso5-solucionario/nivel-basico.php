<?php
// nivel-basico.php — 🟢 1–4 (Lección 14 · OCP).
echo "P1: OCP = agregar comportamiento NUEVO escribiendo código NUEVO, sin editar lo que ya funciona\n";
// P2: descuento20 con precioFinal sin tocarla.
function precioFinal(float $precio, callable $regla): float { return $regla($precio); }
$descuento20 = fn(float $p) => $p * 0.8;
echo "P2: " . precioFinal(100, $descuento20) . "\n";   // 80
echo "P3: sí viola el OCP: cada figura nueva obliga a otro elif en area_con_if\n";
// P4: saludos registro + portugués sin tocar saludar.
$saludos = ["es" => fn(string $n) => "Hola, $n", "en" => fn(string $n) => "Hi, $n"];
function saludar(array $s, string $idioma, string $nombre): string { return $s[$idioma]($nombre); }
$saludos["pt"] = fn(string $n) => "Olá, $n";
echo "P4: " . saludar($saludos, "pt", "Ana") . "\n";
