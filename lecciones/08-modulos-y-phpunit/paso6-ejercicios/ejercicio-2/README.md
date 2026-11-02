# Ejercicio 2 — Módulo vs copiar y pegar

> Lección 08 · refuerzo.

**Problema:**
1. Usa la función iva() desde varios sitios.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function iva(float $precio): float { return $precio * 1.18; } // copiada aquí...
echo iva(100) . "\n";
// ...y copiada igual en otros 5 archivos. Si cambia el IVA, hay que editar los 6.
```
🔴 **Qué hace mal:** copia y pega la misma función en cada archivo; cambiarla obliga a editar todos.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
require_once __DIR__ . '/impuestos.php';  // un solo lugar define iva()
echo iva(100) . "\n";
```
🟢 **Qué mejoró:** la función vive en un módulo; los demás la importan con require.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
