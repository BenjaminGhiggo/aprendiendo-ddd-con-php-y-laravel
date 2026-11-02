# Reto — Un único punto de contacto con el dominio

> Cap. 5 · micro-paso 1 · refuerzo. Cita (regla 6): *"rewrite its API to work in terms of primitives."* — Cap. 5.

**Problema:**
1. Haz que **un solo** punto del código conozca cómo se construyen `Lote`/`LineaPedido`; todos los tests hablan en primitivos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: muchos tests conocen el constructor; el dominio esta "filtrado" por todo el suite.
final class Lote { public function __construct(public readonly string $ref, public readonly string $sku, public readonly int $cant) {} }
// test A
$a = new Lote("l1", "LAMPARA", 100);
// test B
$b = new Lote("l2", "MESA", 50);
// test C ... cada uno repite y conoce el constructor
echo $a->ref . " " . $b->ref . "\n";
```
🔴 **Qué hace mal:** muchos tests repiten `new Lote(...)`: el constructor del dominio está filtrado por todo el suite.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: un solo helper de servicio conoce el constructor; los tests solo usan primitivos.
final class Lote { public function __construct(public readonly string $ref, public readonly string $sku, public readonly int $cant) {} }
function agregarLote(array &$repo, string $ref, string $sku, int $cant): void {
    $repo[] = new Lote($ref, $sku, $cant);   // UNICO punto que conoce el constructor
}
$repo = [];
agregarLote($repo, "l1", "LAMPARA", 100);    // test A: primitivos
agregarLote($repo, "l2", "MESA", 50);        // test B: primitivos
echo $repo[0]->ref . " " . $repo[1]->ref . "\n";
```
🟢 **Qué mejoró:** un único helper conoce el constructor; los tests hablan en primitivos y el dominio deja de filtrarse por el suite.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
