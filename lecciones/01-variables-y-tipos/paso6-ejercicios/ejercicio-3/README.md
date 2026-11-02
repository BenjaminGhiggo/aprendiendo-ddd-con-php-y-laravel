# Ejercicio 3 — Calcular, no escribir a mano

> variables y tipos · Lección 01 · refuerzo.

**Problema:**
1. Muestra el total de 3 unidades a 100 cada una.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$precio = 100; $cantidad = 3;
echo "Total: 300\n";   // calculado a mano
```
🔴 **Qué hace mal:** escribe el total ya calculado (`300`); si cambian los datos, miente.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$precio = 100; $cantidad = 3;
$total = $precio * $cantidad;
echo "Total: $total\n";
```
🟢 **Qué mejoró:** el total se calcula con las variables; siempre es correcto.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
