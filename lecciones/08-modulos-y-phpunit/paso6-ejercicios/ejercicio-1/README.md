# Ejercicio 1 — Aserción vs mirar a ojo

> Lección 08 · refuerzo. Cita (regla 6): *"We use TDD at work, so we tend to show listings of tests first, followed by implementation."* — Prefacio.

**Problema:**
1. Comprueba que doble(5) da 10.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function doble(int $n): int { return $n * 2; }
echo doble(5) . "\n";  // ¿salió 10? hay que mirarlo cada vez, y es fácil equivocarse
```
🔴 **Qué hace mal:** 'comprueba' mirando la salida a ojo cada vez; es fácil equivocarse.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function doble(int $n): int { return $n * 2; }
$esperado = 10;
$real = doble(5);
echo ($esperado === $real ? "OK" : "FALLA: esperaba $esperado, obtuve $real") . "\n";
```
🟢 **Qué mejoró:** una aserción comprueba sola y avisa si falla (es lo que hace PHPUnit).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
