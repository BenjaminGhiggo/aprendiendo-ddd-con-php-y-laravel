# Ejercicio 3 — Parámetro por defecto

> Lección 04 · refuerzo.

**Problema:**
1. Calcula el total de un precio, con y sin IVA (18%).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function total(float $precio): float { return $precio; }
function totalConIva(float $precio): float { return $precio * 1.18; }
echo total(100) . "\n";
echo totalConIva(100) . "\n";
```
🔴 **Qué hace mal:** crea dos funciones casi iguales solo por el IVA.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function total(float $precio, float $factor = 1.0): float { return $precio * $factor; }
echo total(100) . "\n";       // sin iva
echo total(100, 1.18) . "\n"; // con iva
```
🟢 **Qué mejoró:** un parámetro por defecto cubre los dos casos con una sola función.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
