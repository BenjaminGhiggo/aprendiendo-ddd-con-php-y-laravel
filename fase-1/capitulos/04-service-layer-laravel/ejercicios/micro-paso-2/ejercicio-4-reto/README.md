# Reto — Respuesta estructurada (estado + cuerpo)

> Cap. 4 · micro-paso 2 · refuerzo. Cita (regla 6): *"We show how this layer makes it easy to build thin entrypoints to our system."* — Preface.

**Problema:**
1. El controlador debe devolver algo probable sin HTTP: un array `['estado' => ..., 'cuerpo' => ...]`, no texto suelto.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el controlador imprime/HTML directamente; el test no puede inspeccionar estado ni cuerpo.
final class AsignarController {
    public function asignar(array $p): void {
        echo "HTTP 201 Created\n";          // mezcla la respuesta con el formato de salida
        echo "referencia: lote-1\n";
    }
}
(new AsignarController())->asignar(["sku" => "LAMPARA"]);
```
🔴 **Qué hace mal:** el controlador imprime la respuesta directamente: el test no puede comprobar el código de estado ni el cuerpo por separado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: devuelve estado + cuerpo estructurados; el test los inspecciona sin levantar un servidor.
final class AsignarController {
    /** @return array{estado:int, cuerpo:array<string,mixed>} */
    public function asignar(array $p): array {
        return ["estado" => 201, "cuerpo" => ["referencia" => "lote-1"]];
    }
}
$resp = (new AsignarController())->asignar(["sku" => "LAMPARA"]);
echo $resp["estado"] . "\n";                     // 201
echo $resp["cuerpo"]["referencia"] . "\n";       // lote-1
```
🟢 **Qué mejoró:** devolver `['estado'=>..., 'cuerpo'=>...]` deja al test comprobar código y datos por separado, sin servidor HTTP.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
