# Ejercicio 2 — Dependencias inyectadas, no creadas dentro

> Cap. 4 · micro-paso 2 · refuerzo. Cita (regla 6): *"the service layer ... depends on an abstraction (the repository)."* — Cap. 4.

**Problema:**
1. El controlador necesita un repositorio. ¿Lo crea él mismo (`new RepositorioEloquent`) o lo recibe por el constructor?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el controlador CREA sus dependencias dentro; queda atado a una implementacion concreta.
final class RepositorioEloquent { public function listar(): array { return ["lote-1"]; } }
final class AsignarController {
    public function asignar(): string {
        $repo = new RepositorioEloquent();   // acoplado: no puedo meter un falso en el test
        return $repo->listar()[0];
    }
}
echo (new AsignarController())->asignar() . "\n";
```
🔴 **Qué hace mal:** el controlador instancia su repositorio concreto por dentro: no puedes sustituirlo por un falso en los tests.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: el repositorio llega por el CONSTRUCTOR (el contenedor de Laravel lo inyecta — cap. 13).
interface RepositorioDeLotes { public function listar(): array; }
final class RepositorioFalso implements RepositorioDeLotes {
    public function listar(): array { return ["lote-1"]; }
}
final class AsignarController {
    public function __construct(private readonly RepositorioDeLotes $repo) {}
    public function asignar(): string { return $this->repo->listar()[0]; }
}
// En el test inyecto un falso; en produccion Laravel inyecta el Eloquent.
echo (new AsignarController(new RepositorioFalso()))->asignar() . "\n";
```
🟢 **Qué mejoró:** el repositorio llega por el constructor contra una interfaz: el test inyecta un falso y produción inyecta Eloquent.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
