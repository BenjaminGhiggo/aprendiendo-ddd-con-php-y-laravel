# Ejercicio 3 — Desasignar seguro

> Cap. 1 · micro-paso 3 · refuerzo.

**Problema:**
1. Desasignar una línea que no estaba no debe cambiar el stock.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Lote {
    public int $disponible;
    public function __construct(int $cantidad) { $this->disponible = $cantidad; }
    public function desasignar(int $c): void { $this->disponible += $c; }
}
$lote = new Lote(20);
$lote->desasignar(2); // nunca estuvo asignada
echo $lote->disponible . "\n"; // 22 (¡apareció stock de la nada!)
```
🔴 **Qué hace mal:** suma a mano; devuelve stock que no existía.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class LineaPedido {
    public function __construct(public readonly string $sku, public readonly int $cantidad) {}
    public function clave(): string { return "{$this->sku}|{$this->cantidad}"; }
}
final class Lote {
    private array $asignaciones = [];
    public function __construct(private int $comprado) {}
    public function desasignar(LineaPedido $l): void { unset($this->asignaciones[$l->clave()]); }
    public function disponible(): int { $s = 0; foreach ($this->asignaciones as $l) $s += $l->cantidad; return $this->comprado - $s; }
}
$lote = new Lote(20);
$lote->desasignar(new LineaPedido("MESA", 2)); // no estaba: no pasa nada
echo $lote->disponible() . "\n"; // 20
```
🟢 **Qué mejoró:** quita del array; si no estaba, no cambia nada.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
