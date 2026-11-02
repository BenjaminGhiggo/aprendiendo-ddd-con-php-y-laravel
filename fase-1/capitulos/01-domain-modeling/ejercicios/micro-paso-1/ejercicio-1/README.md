# Ejercicio 1 — Value object inmutable

> Cap. 1 · micro-paso 1 · refuerzo. Cita (regla 6): *"a value object ... we usually make them immutable."* — Cap. 1.

**Problema:**
1. Modela una `LineaPedido` (sku, cantidad). No debería poder cambiar tras crearse.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class LineaPedido { public function __construct(public string $sku, public int $cantidad) {} }
$linea = new LineaPedido("MESA", 2);
$linea->cantidad = 999; // nada lo impide
echo $linea->cantidad . "\n";
```
🔴 **Qué hace mal:** la línea es mutable; cambiarle la cantidad la convierte en otra cosa.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$linea = new LineaPedido("MESA", 2);
// $linea->cantidad = 999;  // Error: Cannot modify readonly property LineaPedido::$cantidad
echo $linea->cantidad . "\n";
```
🟢 **Qué mejoró:** con `readonly`, PHP impide cambiar los campos tras crear el objeto.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
