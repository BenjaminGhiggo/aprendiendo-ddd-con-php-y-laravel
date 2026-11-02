# Ejercicio 1 — Controlador gordo vs fino

> Cap. 4 · micro-paso 2 · refuerzo. Cita (regla 6): *"this layer makes it easy to build thin entrypoints to our system, whether it's a Flask API or a CLI."* — Preface.

**Problema:**
1. El controlador web debe ser 'fino': traducir la petición y delegar. ¿Metes la lógica dentro o la delegas al servicio?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: controlador GORDO: valida, asigna y coordina todo dentro. Imposible de reutilizar/probar sin HTTP.
final class AsignarController {
    public function asignar(array $peticion): array {
        $sku = $peticion["sku"];
        $lotes = ["LAMPARA"];                 // logica de negocio aqui dentro
        if (!in_array($sku, $lotes, true)) {
            return ["estado" => 400];
        }
        return ["estado" => 201, "cuerpo" => ["referencia" => "lote-1"]];
    }
}
print_r((new AsignarController())->asignar(["sku" => "LAMPARA"]));
```
🔴 **Qué hace mal:** el controlador acumula validación y orquestación: la lógica queda atada a la web y no se puede reutilizar ni probar sin HTTP.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: controlador FINO: solo traduce la peticion y delega en el servicio.
function servicioAsignar(string $sku): string {
    if ($sku !== "LAMPARA") { throw new \RuntimeException("sku"); }
    return "lote-1";
}
final class AsignarController {
    public function asignar(array $peticion): array {
        try {
            $ref = servicioAsignar($peticion["sku"]);   // delega
        } catch (\RuntimeException $e) {
            return ["estado" => 400];
        }
        return ["estado" => 201, "cuerpo" => ["referencia" => $ref]];
    }
}
print_r((new AsignarController())->asignar(["sku" => "LAMPARA"]));
```
🟢 **Qué mejoró:** el controlador solo traduce y delega; la lógica vive en el servicio, reutilizable y probable sin HTTP.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
