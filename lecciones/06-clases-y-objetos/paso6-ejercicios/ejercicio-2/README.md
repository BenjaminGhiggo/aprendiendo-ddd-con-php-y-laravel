# Ejercicio 2 — La regla como método

> Lección 06 · refuerzo. Cita (regla 6): *"def can_allocate(self, line: OrderLine) -> bool:"* — Cap. 1.

**Problema:**
1. El lote debe saber decir si puede asignar.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote { public function __construct(public string $sku, public int $disponible) {} }
function puedeAsignar(Lote $lote, string $sku, int $cantidad): bool {
    return $lote->sku === $sku && $lote->disponible >= $cantidad;  // hurga en los datos ajenos
}
$lote = new Lote("MESA", 20);
echo var_export(puedeAsignar($lote, "MESA", 5), true) . "\n";
```
🔴 **Qué hace mal:** pone la regla en una función suelta que hurga en los datos del lote desde afuera.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public function __construct(public string $sku, public int $disponible) {}
    public function puedeAsignar(string $sku, int $cantidad): bool {
        return $this->sku === $sku && $this->disponible >= $cantidad;
    }
}
$lote = new Lote("MESA", 20);
echo var_export($lote->puedeAsignar("MESA", 5), true) . "\n";
```
🟢 **Qué mejoró:** la regla es un método del objeto; el lote responde por sí mismo (como `can_allocate`).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
