# Ejercicio 1 — Empaquetar en una función

> Lección 04 · refuerzo. Cita (regla 6): *"def allocate(line: OrderLine, batches: List[Batch]) -> str:"* — Cap. 1.

**Problema:**
1. Calcula el área (base×altura) de tres rectángulos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo (4 * 3) . "\n";
echo (5 * 2) . "\n";
echo (10 * 6) . "\n";  // si cambia la fórmula del área, hay que editar los 3
```
🔴 **Qué hace mal:** repite el mismo cálculo copiado en tres lugares; si la fórmula cambia, hay que editar los tres.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function area(int $base, int $altura): int { return $base * $altura; }
echo area(4, 3) . "\n";
echo area(5, 2) . "\n";
echo area(10, 6) . "\n";
```
🟢 **Qué mejoró:** una función empaqueta el cálculo; se cambia en un solo sitio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
