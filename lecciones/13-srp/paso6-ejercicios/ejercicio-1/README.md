# Ejercicio 1 — Pedido que hace demasiado

> Lección 13 · refuerzo (SRP). Cita (regla 6): *"SOLID ... single responsibility ..."* — Introducción (nota 2).

**Problema:**
1. Un pedido calcula su total, imprime un recibo y se guarda.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Pedido {
    public function __construct(public array $precios) {}
    public function total(): int { return array_sum($this->precios); }
    public function imprimirRecibo(): void { echo "Total: " . $this->total() . "\n"; }
    public function guardar(): void { echo "guardando...\n"; }
}
$p = new Pedido([10, 20, 30]); $p->imprimirRecibo(); $p->guardar();
```
🔴 **Qué hace mal:** `Pedido` tiene **tres razones** para cambiar (total, formato, guardado). Un cambio en cualquiera toca la misma clase.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Pedido { public function __construct(public array $precios) {} public function total(): int { return array_sum($this->precios); } }
function imprimirRecibo(Pedido $p): void { echo "Total: " . $p->total() . "\n"; }
function guardar(Pedido $p): void { echo "guardando...\n"; }
$p = new Pedido([10, 20, 30]); imprimirRecibo($p); guardar($p);
```
🟢 **Qué mejoró:** `Pedido` solo conoce la regla; recibo y guardado son responsabilidades aparte.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
