# Ejercicio 3 — Disponible calculado

> Lección 06 · refuerzo.

**Problema:**
1. Un lote donde, al asignar 2 de 20, el disponible sea 18.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote {
    public int $disponible;
    public function __construct(public int $comprado) { $this->disponible = $comprado; }
}
$lote = new Lote(20);
// si asignamos 2 pero olvidamos restar, 'disponible' miente:
echo $lote->disponible . "\n"; // 20, aunque "ya asignamos"
```
🔴 **Qué hace mal:** 'disponible' es un dato suelto que hay que acordarse de actualizar; si se olvida, miente.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public int $asignado = 0;
    public function __construct(public int $comprado) {}
    public function asignar(int $cantidad): void { $this->asignado += $cantidad; }
    public function disponible(): int { return $this->comprado - $this->asignado; }
}
$lote = new Lote(20);
$lote->asignar(2);
echo $lote->disponible() . "\n"; // 18
```
🟢 **Qué mejoró:** 'disponible' se calcula en un método: comprado menos asignado. No puede descuadrarse.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
