# Ejercicio 2 — Validar el sku ANTES de tocar el estado

> Cap. 6 · micro-paso 3 · refuerzo. Cita (regla 6): *"the Unit of Work (UoW) pattern is our abstraction over the idea of atomic operations."* — Cap. 6.

**Problema:**
1. Si el sku es inválido, el servicio no debería haber tocado nada. Valida antes de asignar.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$lotes = ["MESA"];
function asignar(array $lotes, string $sku): string {
    $resultado = "asignado-a-algo"; // ya asignamos...
    if (!in_array($sku, $lotes)) { return "sku inválido (pero ya tocamos cosas)"; }
    return $resultado;
}
echo asignar($lotes, "INEXISTENTE") . "\n";
```
🔴 **Qué hace mal:** valida después de asignar; ya tocó el estado aunque el sku fuera inválido.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class SkuInvalido extends \Exception {}
$lotes = ["MESA"];
function asignar(array $lotes, string $sku): string {
    if (!in_array($sku, $lotes)) { throw new SkuInvalido("Sku inválido $sku"); }
    return "asignado";
}
try { echo asignar($lotes, "INEXISTENTE") . "\n"; }
catch (SkuInvalido $e) { echo "rechazado antes de tocar nada: " . $e->getMessage() . "\n"; }
```
🟢 **Qué mejoró:** valida primero y lanza `SkuInvalido`; sin `comprometer`, nada se persiste.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
