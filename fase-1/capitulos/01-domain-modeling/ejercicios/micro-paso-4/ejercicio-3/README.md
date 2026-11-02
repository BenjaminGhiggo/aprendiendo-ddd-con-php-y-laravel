# Ejercicio 3 — Excepción del negocio

> Cap. 1 · micro-paso 4 · refuerzo. Cita (regla 6): *"class OutOfStock(Exception): pass ... raise OutOfStock(...)"* — Cap. 1.

**Problema:**
1. Avisar cuando no hay stock para asignar.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Lote { public function __construct(public string $ref, public int $disponible) {} }
function asignar(int $cantidad, array $lotes): string {
    foreach ($lotes as $l) { if ($l->disponible >= $cantidad) return $l->ref; }
    return "ninguno";
}
$ref = asignar(999, [new Lote("a", 5)]);
echo "asignado a: $ref\n"; // "ninguno" pasa desapercibido
```
🔴 **Qué hace mal:** devuelve un string mágico que el que llama puede olvidar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class SinStock extends \Exception {}
final class Lote { public function __construct(public string $ref, public int $disponible) {} }
function asignar(int $cantidad, array $lotes): string {
    foreach ($lotes as $l) { if ($l->disponible >= $cantidad) return $l->ref; }
    throw new SinStock("Sin stock");
}
try { asignar(999, [new Lote("a", 5)]); }
catch (SinStock $e) { echo "hay que reaccionar: " . $e->getMessage() . "\n"; }
```
🟢 **Qué mejoró:** lanza una excepción con nombre del negocio (`SinStock`).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
