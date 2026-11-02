# Ejercicio 3 — Los datos entran por parámetro

> Lección 17 · refuerzo (DIP).

**Problema:**
1. Calcular el total de ventas.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function totalVentas(): int {
    $ventas = [100, 200, 300];
    return array_sum($ventas);
}
```
🔴 **Qué hace mal:** los datos están "cableados" dentro de la función. No se puede calcular
el total con otras ventas sin editarla.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function totalVentas(array $ventas): int {
    return array_sum($ventas);
}
```
🟢 **Qué mejoró:** los datos entran por parámetro. La lógica no depende de su origen y se
reutiliza con cualquier fuente.

**Ver la mejora línea por línea** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
