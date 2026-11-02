# Ejercicio 1 — Un salto de línea por elemento

> Lección 00 · refuerzo. Cita (regla 6): *"the best way to learn about code is to code."* — Preface.

**Problema:**
1. Muestra tres productos, cada uno en su línea.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo "mesasillalampara";
```
🔴 **Qué hace mal:** pega todo en un solo `echo` sin saltos: en pantalla sale `mesasillalampara`.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
echo "mesa\n";
echo "silla\n";
echo "lampara\n";
```
🟢 **Qué mejoró:** un `echo` por línea con `\n`: se lee claro.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
