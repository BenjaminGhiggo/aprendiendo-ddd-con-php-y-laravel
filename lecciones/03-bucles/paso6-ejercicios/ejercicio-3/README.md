# Ejercicio 3 — break: parar al encontrar

> bucles · Lección 03 · refuerzo.

**Problema:**
1. Encuentra el primer número impar de una lista.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$numeros = [2, 4, 7, 8, 9];
$primero = null;
foreach ($numeros as $n) { if ($n % 2 !== 0 && $primero === null) { $primero = $n; } }
echo "Primer impar: $primero\n";
```
🔴 **Qué hace mal:** recorre TODA la lista aunque ya encontró el primero.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$numeros = [2, 4, 7, 8, 9];
foreach ($numeros as $n) { if ($n % 2 !== 0) { echo "Primer impar: $n\n"; break; } }
```
🟢 **Qué mejoró:** con `break`, para en cuanto lo encuentra.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
