<?php
declare(strict_types=1);
// nivel-avanzado.php — problemas 🔴 9–12 (README §10).
function contar(array $palabras, callable $cumple): int { // P9: callable
    $total = 0;
    foreach ($palabras as $p) { if ($cumple($p)) { $total++; } }
    return $total;
}
$esLarga = fn(string $p): bool => strlen($p) > 4;
echo "P9: " . contar(["mesa", "silla", "sofá", "lampara"], $esLarga) . "\n"; // 2

$factor = 3;                                             // P10: use captura
$escalar = function (int $n) use ($factor): int { return $n * $factor; };
echo "P10: " . $escalar(5) . "\n";                       // 15

function aplicarTodas(int $x, array $funciones): array {  // P11: array de funciones
    $out = [];
    foreach ($funciones as $f) { $out[] = $f($x); }
    return $out;
}
echo "P11: " . json_encode(aplicarTodas(4, [fn($n) => $n + 1, fn($n) => $n * 10])) . "\n"; // [5,40]

// P12 (puente al libro): 'asignar' como función que elige el primer lote que alcanza.
function asignar(int $cantidad, array $lotes): string {   // lotes: [referencia => disponible]
    foreach ($lotes as $ref => $disponible) {
        if ($disponible >= $cantidad) { return $ref; }
    }
    return "sin-stock";
}
echo "P12: " . asignar(10, ["lote-a" => 5, "lote-b" => 100]) . "\n"; // lote-b
