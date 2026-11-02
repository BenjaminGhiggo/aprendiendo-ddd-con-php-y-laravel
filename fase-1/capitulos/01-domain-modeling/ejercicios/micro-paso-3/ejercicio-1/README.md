# Ejercicio 1 — No descontar doble

> Cap. 1 · micro-paso 3 · refuerzo. Cita (regla 6): *"available_quantity is now a calculated property ..."* — Cap. 1.

**Problema:**
1. Asignar la misma línea dos veces no debe descontar el doble.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Lote {
    public int $disponible;
    public function __construct(int $cantidad) { $this->disponible = $cantidad; }
    public function asignar(int $c): void { $this->disponible -= $c; }
}
$lote = new Lote(20);
$lote->asignar(2);
$lote->asignar(2); // la MISMA línea otra vez
echo $lote->disponible . "\n"; // 16 (¡debería ser 18!)
```
🔴 **Qué hace mal:** resta a mano; la misma línea descuenta doble.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class LineaPedido {
    public function __construct(public readonly string $id, public readonly string $sku, public readonly int $cantidad) {}
    public function clave(): string { return "{$this->id}|{$this->sku}|{$this->cantidad}"; }
}
final class Lote {
    private array $asignaciones = [];
    public function __construct(private int $comprado) {}
    public function asignar(LineaPedido $l): void { $this->asignaciones[$l->clave()] = $l; }
    public function disponible(): int { $s = 0; foreach ($this->asignaciones as $l) $s += $l->cantidad; return $this->comprado - $s; }
}
$lote = new Lote(20);
$linea = new LineaPedido("pedido-1", "MESA", 2);
$lote->asignar($linea);
$lote->asignar($linea);
echo $lote->disponible() . "\n"; // 18
```
🟢 **Qué mejoró:** array por clave; la misma línea no cuenta dos veces.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
