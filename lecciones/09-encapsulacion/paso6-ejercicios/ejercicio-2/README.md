# Ejercicio 2 — Identidad inmutable

> Lección 09 · refuerzo.

**Problema:**
1. La referencia de un `Lote` no debería cambiar tras crearse.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote { public string $referencia; }
$l = new Lote();
$l->referencia = "lote-001";
$l->referencia = "lote-999"; // ¡le cambiaron la identidad!
echo $l->referencia . "\n";
```
🔴 **Qué hace mal:** la referencia es **pública y mutable**: le cambian la identidad al lote.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public function __construct(public readonly string $referencia) {}
}
$l = new Lote("lote-001");
// $l->referencia = "lote-999"; // Error: Cannot modify readonly property
echo $l->referencia . "\n";
```
🟢 **Qué mejoró:** `readonly` la fija una vez; cambiarla da `Error: Cannot modify readonly property`.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
