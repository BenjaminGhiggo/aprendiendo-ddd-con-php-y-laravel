# Ejercicio 2 — ¿Dónde validar el sku?

> Cap. 4 · micro-paso 1 · refuerzo. Cita (regla 6): *"if not is_valid_sku(line.sku, batches): raise InvalidSku(...)"* — Cap. 4.

**Problema:**
1. Si el sku pedido no existe en ningún lote, hay que rechazarlo. ¿Validas en el modelo o en el servicio?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: la validacion del sku se olvida; el servicio asigna a ciegas y falla raro despues.
function servicioAsignar(string $sku, array $lotes): string {
    // sin validar: si el sku no esta, $lotes[0] podria ni corresponder
    return $lotes[0] ?? "???";
}
echo servicioAsignar("NO-EXISTE", ["LAMPARA" => "lote-1"] === [] ? [] : []) . "\n";
```
🔴 **Qué hace mal:** no valida el sku en la capa de servicios: un sku inexistente se cuela y produce un error confuso más adelante.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: el servicio valida el sku antes de asignar y lanza una excepcion clara.
final class SkuInvalido extends \Exception {}
function skuValido(string $sku, array $skusDisponibles): bool {
    return in_array($sku, $skusDisponibles, true);
}
function servicioAsignar(string $sku, array $skusDisponibles): string {
    if (!skuValido($sku, $skusDisponibles)) {
        throw new SkuInvalido("Sku invalido {$sku}");
    }
    return "lote-1";
}
try {
    servicioAsignar("NO-EXISTE", ["LAMPARA"]);
} catch (SkuInvalido $e) {
    echo $e->getMessage() . "\n";   // Sku invalido NO-EXISTE
}
```
🟢 **Qué mejoró:** el servicio valida la entrada y falla con un mensaje claro (`SkuInvalido`) antes de tocar el dominio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
