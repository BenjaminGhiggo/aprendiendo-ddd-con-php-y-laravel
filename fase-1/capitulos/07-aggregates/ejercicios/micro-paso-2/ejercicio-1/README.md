# Ejercicio 1 — El repositorio devuelve el agregado, no lotes sueltos

> Cap. 7 · micro-paso 2 · refuerzo. Cita (regla 6): *"One Aggregate = One Repository."* — Cap. 7.

**Problema:**
1. El repositorio debe obtener el agregado `Producto` por su sku, no lotes sueltos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$repoLotes = ['l1' => ['sku' => 'MESA'], 'l2' => ['sku' => 'MESA']];
echo "obtiene lote suelto: l1 (sku {$repoLotes['l1']['sku']})\n"; // sin la frontera del agregado
```
🔴 **Qué hace mal:** devuelve lotes sueltos; las reglas del sku quedan repartidas, sin frontera.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Producto { public function __construct(public string $sku, public array $lotes) {} }
final class RepoProductos {
    private array $productos = [];
    public function agregar(Producto $p): void { $this->productos[$p->sku] = $p; }
    public function obtener(string $sku): ?Producto { return $this->productos[$sku] ?? null; }
}
$repo = new RepoProductos();
$repo->agregar(new Producto('MESA', ['l1', 'l2']));
echo "obtiene agregado: MESA con " . count($repo->obtener('MESA')->lotes) . " lotes\n";
```
🟢 **Qué mejoró:** el repositorio devuelve el agregado completo: un agregado = un repositorio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
