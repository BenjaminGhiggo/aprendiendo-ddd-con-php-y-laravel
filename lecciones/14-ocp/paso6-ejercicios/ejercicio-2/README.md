# Ejercicio 2 — Área por tipo

> Lección 14 · refuerzo.

**Problema:**
1. Calcular el área de distintas figuras.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function area(string $figura, float $a, float $b): float {
    if ($figura === "rectangulo") { return $a * $b; }
    elseif ($figura === "cuadrado") { return $a * $a; }
    return 0;
}
echo area("cuadrado", 4, 0) . "\n";
```
🔴 **Qué hace mal:** un if por tipo; cada figura nueva obliga a editar la función.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
abstract class Figura { abstract public function area(): float; }
class Rectangulo extends Figura { public function __construct(private float $a, private float $b) {} public function area(): float { return $this->a * $this->b; } }
class Cuadrado extends Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
echo (new Cuadrado(4))->area() . "\n";
```
🟢 **Qué mejoró:** polimorfismo: una figura nueva es una clase nueva (OCP).

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
