# Ejercicio 3 — Código compartido en la base

> Lección 12 · refuerzo.

**Problema:**
1. `describir()` igual para todas las figuras.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Rectangulo { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } public function describir(): string { return "área = " . $this->area(); } }
class Triangulo { public function __construct(private float $b, private float $h) {} public function area(): float { return ($this->b * $this->h) / 2; } public function describir(): string { return "área = " . $this->area(); } }
echo (new Rectangulo(2, 3))->describir() . "\n";
```
🔴 **Qué hace mal:** repite `describir()` en cada hija (código duplicado).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
abstract class Figura {
    abstract public function area(): float;
    public function describir(): string { return "área = " . $this->area(); } // compartido
}
class Rectangulo extends Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } }
class Triangulo extends Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return ($this->b * $this->h) / 2; } }
echo (new Rectangulo(2, 3))->describir() . "\n";
```
🟢 **Qué mejoró:** la abstracta trae `describir()` una vez; las hijas solo implementan `area()`.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
