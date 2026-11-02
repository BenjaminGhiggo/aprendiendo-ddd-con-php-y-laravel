# Ejercicio 3 — Disponible calculado

> Cap. 1 · micro-paso 1 · refuerzo.

**Problema:**
1. Un `Lote` donde, al asignar 2 de 20, el disponible sea 18.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote { public int $disponible; public function __construct(public string $ref, int $cantidad) { $this->disponible = $cantidad; } }
$lote = new Lote("lote-001", 20);
// si asignamos 2 pero olvidamos restar, 'disponible' miente:
echo $lote->disponible . "\n"; // 20
```
🔴 **Qué hace mal:** `disponible` es un dato suelto que hay que acordarse de actualizar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Lote {
    private int $asignado = 0;
    public function __construct(public string $ref, private int $comprado) {}
    public function asignar(int $cantidad): void { $this->asignado += $cantidad; }
    public function disponible(): int { return $this->comprado - $this->asignado; }
}
$lote = new Lote("lote-001", 20);
$lote->asignar(2);
echo $lote->disponible() . "\n"; // 18
```
🟢 **Qué mejoró:** `disponible` se calcula: comprado menos asignado.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
