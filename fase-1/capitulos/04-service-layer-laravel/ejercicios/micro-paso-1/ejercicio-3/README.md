# Ejercicio 3 — Probar el servicio sin base de datos

> Cap. 4 · micro-paso 1 · refuerzo. Cita (regla 6): *"The service layer ... we can test it with a fake repository."* — Cap. 4.

**Problema:**
1. Quieres probar `servicioAsignar` rápido y sin BD. ¿Usas una base de datos real o un repositorio falso en memoria?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el "test" depende de una conexion (aqui simulada): lento y fragil.
function servicioAsignar(callable $traerDeLaBD): string {
    $lotes = $traerDeLaBD();      // golpea la BD cada vez
    return $lotes[0];
}
// "test": necesita una BD de verdad para correr
$conexion = fn() => (function () { /* ... abrir socket, SELECT ... */ return ["lote-1"]; })();
echo servicioAsignar($conexion) . "\n";
```
🔴 **Qué hace mal:** el test del servicio depende de una base de datos real: es lento, frágil y no puede correr aislado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: un repositorio FALSO en memoria; el test corre sin BD, instantaneo.
interface RepositorioDeLotes { public function listar(): array; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function __construct(private array $lotes) {}
    public function listar(): array { return $this->lotes; }
}
function servicioAsignar(RepositorioDeLotes $repo): string {
    return $repo->listar()[0];
}
$repo = new RepositorioFalso(["lote-1"]);   // sin BD
echo servicioAsignar($repo) . "\n";
```
🟢 **Qué mejoró:** el repositorio falso da objetos en memoria: el test del servicio no necesita BD y corre al instante.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
