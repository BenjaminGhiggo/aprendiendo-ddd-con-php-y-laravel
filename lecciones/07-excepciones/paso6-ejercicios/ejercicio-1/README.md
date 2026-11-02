# Ejercicio 1 — Lanzar en vez de devolver raro

> Lección 07 · refuerzo. Cita (regla 6): *"class OutOfStock(Exception): pass"* — Cap. 1.

**Problema:**
1. Asigna stock; si piden más de lo que hay, avisa.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function asignar(int $cantidad, int $disponible): int {
    return $disponible - $cantidad;  // si piden de más, da negativo y nadie se entera
}
echo asignar(99, 20) . "\n";  // -79 (¿stock negativo?)
```
🔴 **Qué hace mal:** devuelve un número raro (negativo) que el que llama puede no notar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class SinStock extends \Exception {}
function asignar(int $cantidad, int $disponible): int {
    if ($cantidad > $disponible) { throw new SinStock("sin stock"); }
    return $disponible - $cantidad;
}
try { echo asignar(99, 20) . "\n"; }
catch (SinStock $e) { echo "hay que reaccionar: " . $e->getMessage() . "\n"; }
```
🟢 **Qué mejoró:** lanza un error con nombre del negocio (`SinStock`); no se puede ignorar.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
