# Ejercicio 1 — Igualdad por valor

> Cap. 1 · micro-paso 2 · refuerzo.

**Problema:**
1. Dos `LineaPedido` con los mismos datos deben ser iguales.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$a = new LineaPedido("MESA", 2);
$b = new LineaPedido("MESA", 2);
echo var_export($a === $b, true) . "\n"; // false
```
🔴 **Qué hace mal:** compara con `===`, que mira identidad de instancia: da `false`.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class LineaPedido {
    public function __construct(public readonly string $sku, public readonly int $cantidad) {}
    public function equals(LineaPedido $o): bool { return $this->sku === $o->sku && $this->cantidad === $o->cantidad; }
}
$a = new LineaPedido("MESA", 2);
$b = new LineaPedido("MESA", 2);
echo var_export($a->equals($b), true) . "\n"; // true
```
🟢 **Qué mejoró:** define `equals()` que compara los datos.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
