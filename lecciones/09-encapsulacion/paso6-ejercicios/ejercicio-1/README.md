# Ejercicio 1 — Dato protegido

> Lección 09 · refuerzo. Cita (regla 6): *"The term encapsulation covers two closely related ideas: simplifying behavior and hiding data."* — Introducción.

**Problema:**
1. Un `Lote` cuya cantidad nunca pueda quedar negativa.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote { public int $cantidad; }
$l = new Lote();
$l->cantidad = -999;   // nada lo impide
echo $l->cantidad . "\n";
```
🔴 **Qué hace mal:** la cantidad es **pública**: cualquiera la deja en un valor imposible (`-999`).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public function __construct(private int $cantidad) {
        if ($cantidad < 0) { throw new \InvalidArgumentException("cantidad negativa"); }
    }
    public function cantidad(): int { return $this->cantidad; }
}
echo (new Lote(20))->cantidad() . "\n";
```
🟢 **Qué mejoró:** cantidad **privada** + validación en el constructor; el estado nunca es imposible.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
