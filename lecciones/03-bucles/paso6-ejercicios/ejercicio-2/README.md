# Ejercicio 2 — Acumulador en vez de sumar a mano

> bucles · Lección 03 · refuerzo.

**Problema:**
1. Suma los números de una lista.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$notas = [10, 20, 30];
echo "Suma: " . (10 + 20 + 30) . "\n";
```
🔴 **Qué hace mal:** suma los elementos a mano; si cambia la lista, se descuadra.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$notas = [10, 20, 30];
$suma = 0;
foreach ($notas as $n) { $suma = $suma + $n; }
echo "Suma: $suma\n";
```
🟢 **Qué mejoró:** un acumulador recorre la lista; funciona con cualquier lista.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
