# Ejercicio 3 — Deduplicar por valor

> Cap. 1 · micro-paso 2 · refuerzo.

**Problema:**
1. Evita que la misma línea cuente dos veces.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class LineaPedido { public function __construct(public readonly string $sku, public readonly int $cantidad) {} }
$lista = [];
$lista[] = new LineaPedido("MESA", 2);
$lista[] = new LineaPedido("MESA", 2); // "la misma" línea
echo count($lista) . "\n"; // 2 (esperábamos 1)
```
🔴 **Qué hace mal:** usar los objetos como valores no deduplica por valor.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class LineaPedido {
    public function __construct(public readonly string $sku, public readonly int $cantidad) {}
    public function clave(): string { return "{$this->sku}|{$this->cantidad}"; }
}
$mapa = [];
$l1 = new LineaPedido("MESA", 2);
$l2 = new LineaPedido("MESA", 2);
$mapa[$l1->clave()] = $l1;
$mapa[$l2->clave()] = $l2; // misma clave: no duplica
echo count($mapa) . "\n"; // 1
```
🟢 **Qué mejoró:** un array indexado por la clave del value object sí deduplica.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
