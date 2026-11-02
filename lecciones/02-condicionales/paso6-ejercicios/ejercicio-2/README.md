# Ejercicio 2 — Devolver el booleano directo

> condicionales · Lección 02 · refuerzo.

**Problema:**
1. Guarda si una edad es mayor de 18 en `$esMayor`.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$edad = 20;
if ($edad >= 18) { $esMayor = true; } else { $esMayor = false; }
var_export($esMayor); echo "\n";
```
🔴 **Qué hace mal:** un `if/else` entero solo para guardar `true` o `false`.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$edad = 20;
$esMayor = $edad >= 18;
var_export($esMayor); echo "\n";
```
🟢 **Qué mejoró:** la comparación YA es un booleano; se guarda directo.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
