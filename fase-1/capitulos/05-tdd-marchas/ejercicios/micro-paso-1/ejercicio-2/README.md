# Ejercicio 2 — Preparar datos con primitivos

> Cap. 5 · micro-paso 1 · refuerzo. Cita (regla 6): *"we need to rewrite its API to work in terms of primitives."* — Cap. 5.

**Problema:**
1. Para preparar el escenario del test, en vez de `new Lote(...)` usa un `agregarLote($ref, $sku, $cantidad, $eta)` que reciba primitivos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el test arma el escenario con new Lote(...) a mano; acoplado al constructor del dominio.
final class Lote {
    public function __construct(public readonly string $referencia, public readonly string $sku, public readonly int $cantidad) {}
}
$repo = [];
$repo[] = new Lote("lote-1", "LAMPARA", 100);   // el test conoce el constructor
echo $repo[0]->referencia . "\n";
```
🔴 **Qué hace mal:** el test arma el lote con `new Lote(...)`: cualquier cambio en ese constructor rompe el test de servicio.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: un agregarLote(primitivos) prepara el escenario; el test no toca el constructor.
final class Lote {
    public function __construct(public readonly string $referencia, public readonly string $sku, public readonly int $cantidad) {}
}
function agregarLote(array &$repo, string $ref, string $sku, int $cantidad): void {
    $repo[] = new Lote($ref, $sku, $cantidad);   // el servicio conoce el constructor, el test no
}
$repo = [];
agregarLote($repo, "lote-1", "LAMPARA", 100);    // solo primitivos
echo $repo[0]->referencia . "\n";
```
🟢 **Qué mejoró:** `agregarLote` recibe primitivos y encapsula el constructor: el test prepara datos sin acoplarse al dominio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
