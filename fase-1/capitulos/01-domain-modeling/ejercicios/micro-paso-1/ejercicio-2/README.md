# Ejercicio 2 — Nombres del negocio

> Cap. 1 · micro-paso 1 · refuerzo. Cita (regla 6): *"the names of the classes and variables ... are taken from the business jargon."* — Cap. 1.

**Problema:**
1. Modela la línea con nombres que cualquiera del negocio entienda.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Cosa { public function __construct(public string $a, public int $b) {} }
$x = new Cosa("MESA", 2);
echo $x->a . " " . $x->b . "\n";
```
🔴 **Qué hace mal:** usa nombres técnicos sin relación con el dominio.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$linea = new LineaPedido("MESA", 2);
echo $linea->sku . " " . $linea->cantidad . "\n";
```
🟢 **Qué mejoró:** usa el lenguaje del negocio (regla 6).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
