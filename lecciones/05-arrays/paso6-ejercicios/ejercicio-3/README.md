# Ejercicio 3 — Agregar a un array

> Lección 05 · refuerzo.

**Problema:**
1. Tienes `["mesa", "silla"]` y quieres añadir `"lampara"`.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$productos = ["mesa", "silla"];
$productos = ["mesa", "silla", "lampara"]; // reescribe todo para añadir uno
echo json_encode($productos) . "\n";
```
🔴 **Qué hace mal:** reescribe el array entero para añadir uno.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$productos = ["mesa", "silla"];
$productos[] = "lampara";
echo json_encode($productos) . "\n";
```
🟢 **Qué mejoró:** `$array[] = valor` agrega al final sin tocar lo demás.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
