# Ejercicio 1 — Cuadrado no es un rectángulo

> Lección 15 · refuerzo. Cita (regla 6):  *"Python will refuse to let you instantiate a class that does not implement all the"* — Cap. 2.

**Problema:**
1. Modelar un cuadrado y un rectángulo con su área.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Rectangulo { public int $ancho = 0; public int $alto = 0; public function area(): int { return $this->ancho * $this->alto; } }
class Cuadrado extends Rectangulo { public function setLado(int $l): void { $this->ancho = $l; $this->alto = $l; } }
$c = new Cuadrado(); $c->ancho = 5; $c->alto = 4; // ¡un "cuadrado" con lados distintos!
echo $c->area() . "\n";
```
🔴 **Qué hace mal:** Cuadrado hereda de Rectangulo y rompe su invariante (lados independientes).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
abstract class Figura { abstract public function area(): int; }
class Rectangulo extends Figura { public function __construct(private int $a, private int $b) {} public function area(): int { return $this->a * $this->b; } }
class Cuadrado extends Figura { public function __construct(private int $l) {} public function area(): int { return $this->l * $this->l; } }
echo (new Cuadrado(5))->area() . "\n";
```
🟢 **Qué mejoró:** Cuadrado y Rectangulo son HERMANOS bajo Figura: ninguno impone reglas al otro.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
