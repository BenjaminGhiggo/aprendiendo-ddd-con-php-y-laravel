# Ejercicio 2 — Reutilizar con parent::

> Lección 10 · refuerzo.

**Problema:**
1. Un `Gerente` cuyo salario es el base más un bono.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Empleado { public function __construct(protected int $base) {} }
class Gerente extends Empleado {
    public function __construct(int $base, private int $bono) { parent::__construct($base); }
    public function salario(): int { return $this->base + $this->bono; } // copia la fórmula de la madre
}
echo (new Gerente(1000, 500))->salario() . "\n";
```
🔴 **Qué hace mal:** reescribe la fórmula de la madre; si cambia, hay que tocar dos lugares.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Empleado {
    public function __construct(protected int $base) {}
    public function salario(): int { return $this->base; }
}
class Gerente extends Empleado {
    public function __construct(int $base, private int $bono) { parent::__construct($base); }
    public function salario(): int { return parent::salario() + $this->bono; }
}
echo (new Gerente(1000, 500))->salario() . "\n";
```
🟢 **Qué mejoró:** reutiliza `parent::salario()` y le suma el bono.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
