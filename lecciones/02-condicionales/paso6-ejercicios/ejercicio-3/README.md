# Ejercicio 3 — No repetir la condición

> condicionales · Lección 02 · refuerzo.

**Problema:**
1. Si el monto es ≥ 100, avisa y aplica 10% de descuento.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$monto = 100; $total = $monto;
if ($monto >= 100) { echo "Aplica descuento\n"; }
if ($monto >= 100) { $total = $monto * 0.9; }
echo "$total\n";
```
🔴 **Qué hace mal:** repite la condición `$monto >= 100` en dos lugares.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$monto = 100;
if ($monto >= 100) { echo "Aplica descuento\n"; $total = $monto * 0.9; }
else { $total = $monto; }
echo "$total\n";
```
🟢 **Qué mejoró:** una sola decisión; la condición vive en un solo lugar.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
