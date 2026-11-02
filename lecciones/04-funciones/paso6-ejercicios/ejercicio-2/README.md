# Ejercicio 2 — Devolver vs imprimir

> Lección 04 · refuerzo.

**Problema:**
1. Suma dos números y usa el resultado (multiplícalo por 10).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function suma(int $a, int $b): void { echo ($a + $b) . "\n"; }
suma(2, 3);          // imprime 5
// pero no puedo hacer "suma(2,3) * 10": no devuelve nada
```
🔴 **Qué hace mal:** la función IMPRIME el resultado, así que no puedes reutilizarlo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function suma(int $a, int $b): int { return $a + $b; }
$r = suma(2, 3);
echo ($r * 10) . "\n";  // 50: ahora sí puedo usar lo devuelto
```
🟢 **Qué mejoró:** la función DEVUELVE el resultado; quien llama decide qué hacer con él.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
