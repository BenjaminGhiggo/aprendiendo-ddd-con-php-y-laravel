# Ejercicio 3 — Demasiada marcha baja = frágil ante refactors

> Cap. 5 · micro-paso 2 · refuerzo. Cita (regla 6): *"Once we're off and running, we can go faster ... by changing into a high gear."* — Cap. 5.

**Problema:**
1. Tienes el diseño asentado y quieres que los tests sobrevivan a refactors. ¿Sigues todo en marcha baja o subes a alta?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: TODO en marcha baja; un refactor interno del dominio rompe muchos tests aunque el comportamiento no cambie.
final class Lote {
    public function __construct(public readonly string $ref, public int $cantidadComprada) {}
    public function asignado(): int { return 0; }   // detalle interno que el test observa
}
$lote = new Lote("lote-1", 100);
// el test mira campos internos: si renombro cantidadComprada, se rompe
echo ($lote->cantidadComprada === 100 ? "OK" : "mal") . "\n";
```
🔴 **Qué hace mal:** con todo en marcha baja el test observa detalles internos: renombrar un campo lo rompe aunque el comportamiento sea idéntico.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: comportamiento en marcha ALTA; el test no mira campos internos, solo el resultado observable.
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    return "lote-1";   // da igual como este hecho el dominio por dentro
}
// El test comprueba comportamiento; sobrevive a refactors internos del dominio:
echo servicioAsignar("o1", "LAMPARA", 10) . "\n";
```
🟢 **Qué mejoró:** en marcha alta el test mira solo el resultado observable: los refactors internos del dominio ya no lo rompen.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
