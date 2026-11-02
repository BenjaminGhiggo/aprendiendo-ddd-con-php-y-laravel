# Ejercicio 2 — Una línea con comas

> Lección 00 · refuerzo.

**Problema:**
1. Muestra `dos mas tres` en una sola línea.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo "dos";
echo " ";
echo "mas";
echo " ";
echo "tres";
echo "\n";
```
🔴 **Qué hace mal:** usa muchos `echo` sueltos para una línea; se repite el trabajo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
echo "dos", " ", "mas", " ", "tres", "\n";
```
🟢 **Qué mejoró:** un solo `echo` con comas separa los trozos.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
