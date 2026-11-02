# Ejercicio 1 — ¿Quién orquesta el caso de uso?

> Cap. 4 · micro-paso 1 · refuerzo. Cita (regla 6): *"def allocate(line, repo, session): ... batchref = model.allocate(line, batches) session.commit()"* — Cap. 4.

**Problema:**
1. El caso de uso 'asignar' debe traer los lotes, llamar al dominio y confirmar. ¿Dónde vive esa orquestación?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: el MODELO orquesta (busca en el repositorio y confirma). Mezcla reglas con coordinacion.
final class Lote {
    public function __construct(public readonly string $referencia) {}
    // El dominio NO deberia conocer el repositorio ni la sesion:
    public function asignarUsando(array $repo): string {
        $todos = $repo;                 // "traer" metido en el modelo
        return $todos[0]->referencia;   // y ademas coordina
    }
}
$lotes = [new Lote("lote-1")];
echo (new Lote("x"))->asignarUsando($lotes) . "\n";
```
🔴 **Qué hace mal:** el modelo conoce el repositorio y coordina el caso de uso: mezcla reglas de negocio con orquestación.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: el modelo solo tiene la regla; un SERVICIO orquesta (traer, llamar al dominio).
final class Lote {
    public function __construct(public readonly string $referencia) {}
}
function asignar(Lote $linea, array $lotes): string {   // regla de dominio pura
    return $lotes[0]->referencia;
}
function servicioAsignar(Lote $linea, array $repo): string {  // orquesta
    $lotes = $repo;                     // 1. traer
    return asignar($linea, $lotes);     // 2. llamar al dominio
}
$lotes = [new Lote("lote-1")];
echo servicioAsignar(new Lote("x"), $lotes) . "\n";
```
🟢 **Qué mejoró:** el modelo queda con la regla pura y el servicio coordina el caso de uso. Cada uno tiene una sola responsabilidad.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
