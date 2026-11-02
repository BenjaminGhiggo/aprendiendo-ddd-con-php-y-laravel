# Ejercicio 2 — Igualdad por identidad

> Cap. 1 · micro-paso 2 · refuerzo.

**Problema:**
1. Un lote sigue siendo el mismo aunque cambie su stock.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Lote {
    public function __construct(public string $ref, public int $stock) {}
    public function equals(Lote $o): bool { return $this->ref === $o->ref && $this->stock === $o->stock; }
}
$antes = new Lote("lote-001", 20);
$despues = new Lote("lote-001", 18);
echo var_export($antes->equals($despues), true) . "\n"; // false (¡pero es el mismo lote!)
```
🔴 **Qué hace mal:** compara todos los datos; deja de ser el mismo al cambiar el stock.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Lote {
    public function __construct(public string $ref, public int $stock) {}
    public function equals(Lote $o): bool { return $o->ref === $this->ref; }
}
$antes = new Lote("lote-001", 20);
$despues = new Lote("lote-001", 18);
echo var_export($antes->equals($despues), true) . "\n"; // true: sigue siendo el mismo lote
```
🟢 **Qué mejoró:** una entidad compara solo su identidad (la referencia).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
