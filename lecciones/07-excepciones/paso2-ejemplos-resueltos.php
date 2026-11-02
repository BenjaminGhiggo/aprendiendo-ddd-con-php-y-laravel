<?php
declare(strict_types=1);
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 07. Los 4 ejemplos del README (§9).

echo "--- Ejemplo 1: lanzar en vez de devolver un valor raro (fácil) ---\n";
function raizCuadrada(int $n): float {
    if ($n < 0) { throw new \InvalidArgumentException("no hay raíz real de un negativo"); }
    return sqrt($n);
}
try {
    echo raizCuadrada(9) . "\n";     // 3
    echo raizCuadrada(-4) . "\n";    // lanza
} catch (\InvalidArgumentException $e) {
    echo "error: " . $e->getMessage() . "\n";
}

echo "\n--- Ejemplo 2: tu propia excepción con nombre del negocio (fácil) ---\n";
class SaldoInsuficiente extends \Exception {}
function retirar(int $saldo, int $monto): int {
    if ($monto > $saldo) { throw new SaldoInsuficiente("faltan " . ($monto - $saldo)); }
    return $saldo - $monto;
}
try {
    echo "nuevo saldo: " . retirar(100, 150) . "\n";
} catch (SaldoInsuficiente $e) {
    echo "SaldoInsuficiente: " . $e->getMessage() . "\n";
}

echo "\n--- Ejemplo 3: finally siempre corre (intermedio) ---\n";
function conRecurso(bool $falla): void {
    echo "  abro el recurso\n";
    try {
        if ($falla) { throw new \RuntimeException("algo salió mal"); }
        echo "  uso el recurso\n";
    } catch (\RuntimeException $e) {
        echo "  atrapo: " . $e->getMessage() . "\n";
    } finally {
        echo "  cierro el recurso (finally)\n"; // pase lo que pase
    }
}
conRecurso(false);
conRecurso(true);

echo "\n--- Ejemplo 4: el error sube hasta quien puede manejarlo (avanzado) ---\n";
class SinStock extends \Exception {}
function asignarLinea(int $cantidad, int $disponible): int {
    if ($cantidad > $disponible) { throw new SinStock("sin stock"); } // no lo atrapa aquí
    return $disponible - $cantidad;
}
function procesarPedido(int $cantidad, int $disponible): void {
    asignarLinea($cantidad, $disponible); // deja que el error suba
}
try {
    procesarPedido(99, 20);
} catch (SinStock $e) {
    echo "arriba decidimos qué hacer: " . $e->getMessage() . "\n";
}
