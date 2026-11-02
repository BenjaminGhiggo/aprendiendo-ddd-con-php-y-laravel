# Ejercicio 3 — === vs == en los tests

> Lección 08 · refuerzo.

**Problema:**
1. Comprueba que un resultado es 5 (número).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$real = "5";       // viene como texto, por error
$esperado = 5;
echo ($esperado == $real ? "OK (pero oculta un bug de tipo)" : "FALLA") . "\n";
```
🔴 **Qué hace mal:** compara con == (débil): da por iguales '5' (texto) y 5 (número), ocultando un bug.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$real = "5";
$esperado = 5;
echo ($esperado === $real ? "OK" : "FALLA: tipos distintos ('$real' no es $esperado)") . "\n";
```
🟢 **Qué mejoró:** compara con === (estricto): distingue tipos y atrapa el bug.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
