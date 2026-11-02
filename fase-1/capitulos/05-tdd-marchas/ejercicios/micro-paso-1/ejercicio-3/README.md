# Ejercicio 3 — Sobrevivir a un refactor del constructor

> Cap. 5 · micro-paso 1 · refuerzo. Cita (regla 6): *"fully decoupled from the domain"* — Cap. 5.

**Problema:**
1. Si mañana `LineaPedido` cambia su constructor, ¿qué test se rompe: el que usa objetos o el que usa primitivos?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el test construye el objeto; si el constructor cambia de orden/firma, el test se rompe.
final class LineaPedido {
    // imagina que ayer era (sku, cantidad) y hoy es (idPedido, sku, cantidad): este test ya no compila igual
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(LineaPedido $l): string { return "lote-1"; }
// Habia que reescribir TODOS los tests que hacian new LineaPedido(...)
echo servicioAsignar(new LineaPedido("o1", "LAMPARA", 10)) . "\n";
```
🔴 **Qué hace mal:** al construir el objeto en el test, un cambio en el constructor obliga a reescribir todos los tests de servicio.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: el test pasa primitivos; cambie como cambie el constructor, el test NO se toca.
final class LineaPedido {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    $linea = new LineaPedido($idPedido, $sku, $cantidad);   // el unico lugar que conoce el constructor
    return "lote-1";
}
// Si el constructor cambia, solo cambia el servicio; este test sigue igual:
echo servicioAsignar("o1", "LAMPARA", 10) . "\n";
```
🟢 **Qué mejoró:** con primitivos solo el servicio conoce el constructor; un refactor del dominio no toca los tests de servicio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
