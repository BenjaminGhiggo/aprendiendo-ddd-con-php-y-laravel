# Ejercicio 3 — Traducir la excepción de dominio

> Cap. 4 · micro-paso 2 · refuerzo. Cita (regla 6): *"raise InvalidSku(f'Invalid sku {line.sku}')"* — Cap. 4.

**Problema:**
1. Si el servicio lanza `SkuInvalido`, el controlador debe responder 400, no reventar con un error 500.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el controlador deja escapar la excepcion; el usuario recibe un 500 feo.
final class SkuInvalido extends \Exception {}
function servicioAsignar(string $sku): string {
    throw new SkuInvalido("Sku invalido {$sku}");
}
final class AsignarController {
    public function asignar(array $p): array {
        $ref = servicioAsignar($p["sku"]);   // si lanza, nadie la captura -> 500
        return ["estado" => 201, "cuerpo" => ["referencia" => $ref]];
    }
}
try {
    (new AsignarController())->asignar(["sku" => "NO"]);
} catch (SkuInvalido $e) {
    echo "500 sin controlar: " . $e->getMessage() . "\n";
}
```
🔴 **Qué hace mal:** la excepción de dominio escapa del controlador: el cliente recibe un error 500 en vez de un 400 con el motivo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: el controlador CAPTURA la excepcion de dominio y la traduce a un 400 claro.
final class SkuInvalido extends \Exception {}
function servicioAsignar(string $sku): string {
    throw new SkuInvalido("Sku invalido {$sku}");
}
final class AsignarController {
    public function asignar(array $p): array {
        try {
            $ref = servicioAsignar($p["sku"]);
        } catch (SkuInvalido $e) {
            return ["estado" => 400, "cuerpo" => ["error" => $e->getMessage()]];
        }
        return ["estado" => 201, "cuerpo" => ["referencia" => $ref]];
    }
}
print_r((new AsignarController())->asignar(["sku" => "NO"]));   // estado 400
```
🟢 **Qué mejoró:** el controlador captura `SkuInvalido` y responde 400 con el mensaje: un error esperado, no un 500.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
