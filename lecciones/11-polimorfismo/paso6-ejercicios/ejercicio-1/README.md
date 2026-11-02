# Ejercicio 1 — Sin un if por tipo

> Lección 11 · refuerzo. Cita (regla 6): *"To a Pythonista, a repository is any object that has add(thing) and get(id) methods."* — Cap. 2.

**Problema:**
1. Calcular el área de distintas figuras.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function area(string $tipo, float $x): float {
    if ($tipo === "cuadrado") { return $x * $x; }
    if ($tipo === "circulo") { return 3.14 * $x * $x; }
    return 0.0; // ¿y el rectángulo de mañana?
}
echo area("cuadrado", 4) . "\n";
```
🔴 **Qué hace mal:** usa un `if` por cada tipo; al llegar uno nuevo hay que tocar la función.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
interface Figura { public function area(): float; }
class Cuadrado implements Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
class Circulo implements Figura { public function __construct(private float $r) {} public function area(): float { return 3.14 * $this->r * $this->r; } }
function mostrar(Figura $f): void { echo $f->area() . "\n"; }
mostrar(new Cuadrado(4));
```
🟢 **Qué mejoró:** cada figura implementa `Figura` y sabe su área; el código que las usa no cambia.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
