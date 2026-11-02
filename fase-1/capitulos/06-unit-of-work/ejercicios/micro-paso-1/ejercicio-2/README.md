# Ejercicio 2 — Agrupar repo + confirmación en una UoW

> Cap. 6 · micro-paso 1 · refuerzo. Cita (regla 6): *"It will allow us to finally and fully decouple our service layer from the data layer."* — Cap. 6.

**Problema:**
1. El servicio recibe el "repo" y la "sesión" sueltos y se olvida de confirmar. Agrúpalos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function agregar(array &$repo, bool &$confirmado, string $ref): void {
    $repo[] = $ref;   // guarda en el repo, pero NUNCA confirma
}
$repo = []; $confirmado = false;
agregar($repo, $confirmado, "lote-1");
echo "confirmado: " . var_export($confirmado, true) . "\n"; // false (se perdió)
```
🔴 **Qué hace mal:** repo y confirmación van sueltos; es fácil olvidar el `commit`.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Uow {
    public array $repo = [];
    public bool $comprometido = false;
    public function comprometer(): void { $this->comprometido = true; }
}
function agregar(Uow $uow, string $ref): void { $uow->repo[] = $ref; $uow->comprometer(); }
$uow = new Uow();
agregar($uow, "lote-1");
echo "confirmado: " . var_export($uow->comprometido, true) . "\n"; // true
```
🟢 **Qué mejoró:** la UoW agrupa el repositorio y la confirmación en un solo objeto.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
