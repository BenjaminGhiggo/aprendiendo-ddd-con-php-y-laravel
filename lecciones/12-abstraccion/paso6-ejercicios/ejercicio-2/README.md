# Ejercicio 2 — No instanciar la base

> Lección 12 · refuerzo.

**Problema:**
1. Impedir crear una `Figura` genérica.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Figura { public function area(): float { return 0.0; } } // un área 0 sin sentido
$f = new Figura();
echo $f->area() . "\n";   // 0: una figura abstracta no debería poder existir
```
🔴 **Qué hace mal:** instancia la clase base directamente; no tiene sentido (es un molde incompleto).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
abstract class Figura { abstract public function area(): float; }
class Cuadrado extends Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
// new Figura();  // Error: Cannot instantiate abstract class Figura
echo (new Cuadrado(4))->area() . "\n";   // 16
```
🟢 **Qué mejoró:** `abstract class` no se puede instanciar: solo sus hijas concretas.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
