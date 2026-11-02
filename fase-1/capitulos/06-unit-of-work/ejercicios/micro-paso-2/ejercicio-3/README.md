# Ejercicio 3 — UoW falsa en memoria para los tests

> Cap. 6 · micro-paso 2 · refuerzo. Cita (regla 6): *"Here's how we use a fake UoW in our service-layer tests"* — Cap. 6.

**Problema:**
1. La UoW falsa de los tests no debería tocar una base de datos real. Hazla en memoria.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function uowFalsa(): void { echo "conectando a PostgreSQL...\n"; } // los tests no deberían hacer esto
uowFalsa();
```
🔴 **Qué hace mal:** la "falsa" habla con una base real; los tests dejan de ser rápidos y aislados.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class UowFalsa { public array $repo = []; public bool $comprometido = false;
    public function comprometer(): void { $this->comprometido = true; } }
$u = new UowFalsa(); $u->repo[] = "lote-1"; $u->comprometer();
echo "en memoria, confirmado: " . var_export($u->comprometido, true) . "\n";
```
🟢 **Qué mejoró:** la UoW falsa trabaja en memoria; los tests de servicio corren sin base de datos.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
