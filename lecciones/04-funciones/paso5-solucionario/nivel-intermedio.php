<?php
declare(strict_types=1);
// nivel-intermedio.php — problemas 🟡 5–8 (README §10).
function envio(int $peso, int $base = 10): int { return $base + $peso; } // P5: default
echo "P5: " . envio(5) . " y " . envio(5, 20) . "\n";   // 15 y 25
function clasificar(int $edad): string {                 // P6: return temprano
    if ($edad < 18) { return "menor"; }
    return "adulto";
}
echo "P6: " . clasificar(10) . " / " . clasificar(30) . "\n";
$doble = fn(int $n): int => $n * 2;                      // P7: función flecha
echo "P7: " . $doble(9) . "\n";                          // 18
function sumarLista(array $nums): int {                  // P8: recorrer y acumular
    $suma = 0;
    foreach ($nums as $n) { $suma = $suma + $n; }
    return $suma;
}
echo "P8: " . sumarLista([1, 2, 3, 4]) . "\n";          // 10
