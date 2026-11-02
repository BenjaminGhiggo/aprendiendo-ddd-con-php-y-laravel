# Ejercicio 3 — Sin stock: el agregado lanza `SinStock`

> Cap. 7 · micro-paso 1 · refuerzo. Cita (regla 6): *"An AGGREGATE is a cluster of associated objects that we treat as a unit for the purpose of data changes."* — Cap. 7.

**Problema:**
1. Si ningún lote puede asignar, el agregado debe avisar con una excepción, no en silencio.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function asignar(array $lotes, int $cantidad): string {
    foreach ($lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
    return ""; // nadie se entera de que no habia stock
}
echo "ref='" . asignar([['ref' => 'l1', 'disponible' => 5]], 10) . "'\n"; // ref='' (silencioso)
```
🔴 **Qué hace mal:** devuelve `""`; el fallo pasa desapercibido y se propaga.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class SinStock extends \Exception {}
function asignar(array $lotes, int $cantidad): string {
    foreach ($lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
    throw new SinStock("Sin stock");
}
try { echo asignar([['ref' => 'l1', 'disponible' => 5]], 10) . "\n"; }
catch (SinStock $e) { echo "lanzado: {$e->getMessage()}\n"; }
```
🟢 **Qué mejoró:** lanza `SinStock`: el error es explícito y se maneja arriba.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
