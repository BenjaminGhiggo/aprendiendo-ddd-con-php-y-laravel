# Ejercicio 2 — Caso de uso → marcha alta (servicio)

> Cap. 5 · micro-paso 2 · refuerzo. Cita (regla 6): *"we can go faster and more efficiently by changing into a high gear."* — Cap. 5.

**Problema:**
1. Quieres probar el caso de uso completo ('pedir LAMPARA devuelve una referencia'). ¿Marcha alta o baja?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: probar el caso de uso en marcha BAJA: el test arma todo el dominio a mano, repite detalle inutil.
final class Lote {
    public function __construct(public readonly string $ref, public readonly string $sku, public int $cant) {}
    public function asignar(int $n): void { $this->cant -= $n; }
}
$lote = new Lote("lote-1", "LAMPARA", 100);
$lote->asignar(10);                 // el test reimplementa el caso de uso paso a paso
echo ($lote->cant === 90 ? "lote-1" : "mal") . "\n";
```
🔴 **Qué hace mal:** probar el caso de uso en marcha baja obliga al test a reimplementar la orquestación a mano, con detalle que no aporta.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: caso de uso en marcha ALTA (servicio con primitivos): el test expresa el comportamiento, no el detalle.
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    // el servicio orquesta por dentro
    return "lote-1";
}
$ref = servicioAsignar("o1", "LAMPARA", 10);   // solo primitivos, comportamiento
echo $ref . "\n";                              // lote-1
```
🟢 **Qué mejoró:** en marcha alta el test del caso de uso habla de comportamiento con primitivos, sin reimplementar el dominio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
