# Ejercicio 1 — El servicio recibe primitivos

> Cap. 5 · micro-paso 1 · refuerzo. Cita (regla 6): *"To have a service layer that's fully decoupled from the domain, we need to rewrite its API to work in terms of primitives."* — Cap. 5.

**Problema:**
1. El servicio recibía un objeto `LineaPedido`. Reescríbelo para que reciba `($idPedido, $sku, $cantidad)` y arme la línea por dentro.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el servicio recibe un objeto de dominio; el test debe construirlo (acoplado al constructor).
final class LineaPedido {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(LineaPedido $linea): string {
    return "lote-1";
}
// test acoplado: tiene que saber como se construye LineaPedido
echo servicioAsignar(new LineaPedido("o1", "LAMPARA", 10)) . "\n";
```
🔴 **Qué hace mal:** el test del servicio debe construir un `LineaPedido`: queda acoplado a la forma del constructor del dominio.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: el servicio recibe primitivos y arma la linea por dentro; el test solo pasa strings/ints.
final class LineaPedido {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    $linea = new LineaPedido($idPedido, $sku, $cantidad);   // el servicio ARMA la linea
    return "lote-1";
}
// test desacoplado: solo primitivos
echo servicioAsignar("o1", "LAMPARA", 10) . "\n";
```
🟢 **Qué mejoró:** el servicio recibe primitivos y construye la línea por dentro: el test ya no conoce el constructor del dominio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
