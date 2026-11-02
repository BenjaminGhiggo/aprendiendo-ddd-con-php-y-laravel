# Ejercicio 2 — puedeAsignar completo

> Cap. 1 · micro-paso 3 · refuerzo.

**Problema:**
1. Solo asignar si el sku coincide y hay cantidad.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Lote {
    public function __construct(public string $sku, public int $disponible) {}
    public function puedeAsignar(string $sku, int $cantidad): bool { return $this->disponible >= $cantidad; }
}
$lote = new Lote("MESA", 100);
echo var_export($lote->puedeAsignar("TOSTADORA", 10), true) . "\n"; // true (¡pero el sku no coincide!)
```
🔴 **Qué hace mal:** solo mira la cantidad; ignora el sku.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Lote {
    public function __construct(public string $sku, public int $disponible) {}
    public function puedeAsignar(string $sku, int $cantidad): bool { return $this->sku === $sku && $this->disponible >= $cantidad; }
}
$lote = new Lote("MESA", 100);
echo var_export($lote->puedeAsignar("TOSTADORA", 10), true) . "\n"; // false
echo var_export($lote->puedeAsignar("MESA", 10), true) . "\n";      // true
```
🟢 **Qué mejoró:** exige sku igual **y** cantidad suficiente.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
