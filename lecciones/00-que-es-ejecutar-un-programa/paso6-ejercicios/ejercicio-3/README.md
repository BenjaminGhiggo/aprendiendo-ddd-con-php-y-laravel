# Ejercicio 3 — Deja que PHP calcule

> Lección 00 · refuerzo.

**Problema:**
1. Muestra el resultado de `2 + 3`.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo "2 + 3 = 5\n";   // si cambian los números, hay que recalcular a mano
```
🔴 **Qué hace mal:** escribe el resultado como texto fijo (`5`); si cambian los números, hay que recalcular a mano.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
echo "2 + 3 = ", 2 + 3, "\n";
```
🟢 **Qué mejoró:** deja que PHP haga la cuenta; el resultado se ajusta solo.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
