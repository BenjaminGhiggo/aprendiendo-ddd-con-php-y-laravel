# Reto — No olvidar el commit

> Cap. 4 · micro-paso 1 · refuerzo. Cita (regla 6): *"batchref = model.allocate(line, batches) session.commit() return batchref"* — Cap. 4.

**Problema:**
1. El caso de uso debe **confirmar** (commit) al terminar. Si no, los cambios se pierden. Haz que el servicio confirme con una sesión inyectada.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el servicio asigna pero NUNCA confirma; los cambios no se persisten.
function servicioAsignar(string $sku): string {
    $referencia = "lote-1";   // ... asigno ...
    // falta el commit: en una BD real esto se perderia al cerrar
    return $referencia;
}
echo servicioAsignar("LAMPARA") . "\n";
```
🔴 **Qué hace mal:** el servicio asigna pero nunca confirma: con una BD real los cambios se pierden al cerrar la conexión.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: una Sesion inyectada; el servicio confirma al final (como session.commit() del libro).
interface Sesion { public function commit(): void; }
final class SesionFalsa implements Sesion {
    public bool $comprometida = false;
    public function commit(): void { $this->comprometida = true; }
}
function servicioAsignar(string $sku, Sesion $sesion): string {
    $referencia = "lote-1";   // ... asigno ...
    $sesion->commit();        // confirmo
    return $referencia;
}
$sesion = new SesionFalsa();
servicioAsignar("LAMPARA", $sesion);
echo ($sesion->comprometida ? "confirmado" : "sin confirmar") . "\n";   // confirmado
```
🟢 **Qué mejoró:** la sesión inyectada deja probar que el servicio confirmó (`$sesion->comprometida`), siguiendo el `session.commit()` del libro.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
