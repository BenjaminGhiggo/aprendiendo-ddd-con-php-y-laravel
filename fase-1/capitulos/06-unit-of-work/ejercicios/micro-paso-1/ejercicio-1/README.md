# Ejercicio 1 — Una frontera atómica (todo o nada)

> Cap. 6 · micro-paso 1 · refuerzo. Cita (regla 6): *"the Unit of Work (UoW) pattern is our abstraction over the idea of atomic operations."* — Cap. 6.

**Problema:**
1. Guarda dos lotes. Si el segundo paso falla, el primero NO debería quedar a medias.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$guardados = [];
$guardados[] = "lote-A";          // se guarda
// ... aquí falla el segundo paso, pero "lote-A" ya quedó guardado (estado inconsistente)
echo "guardado suelto: " . implode(",", $guardados) . "\n";
```
🔴 **Qué hace mal:** no hay frontera: un fallo a la mitad deja datos a medias.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function ejecutarAtomico(callable $trabajo): void {
    $pendientes = [];
    try { $trabajo($pendientes); }
    catch (\Throwable $e) { $pendientes = []; echo "deshecho todo por: " . $e->getMessage() . "\n"; return; }
    echo "confirmado: " . implode(",", $pendientes) . "\n";
}
ejecutarAtomico(function (array &$p) { $p[] = "lote-A"; $p[] = "lote-B"; });
```
🟢 **Qué mejoró:** o se confirman los dos, o ninguno: la operación es **atómica**.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
