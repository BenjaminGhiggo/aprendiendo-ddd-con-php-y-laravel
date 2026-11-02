# Ejercicio 3 — Invariante protegida

> Lección 09 · refuerzo.

**Problema:**
1. Asignar no debe dejar la cantidad por debajo de 0.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote { public int $disponible = 10; }
$l = new Lote();
$l->disponible -= 999; // nadie comprobó: queda negativo
echo $l->disponible . "\n";
```
🔴 **Qué hace mal:** quien usa el lote tiene que acordarse de validar antes de restar; si olvida, queda negativo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public function __construct(private int $disponible = 10) {}
    public function disponible(): int { return $this->disponible; }
    public function asignar(int $n): void {
        if ($n > $this->disponible) { throw new \DomainException("sin stock"); }
        $this->disponible -= $n;
    }
}
$l = new Lote();
try { $l->asignar(999); } catch (\DomainException $e) { echo "bloqueado: " . $e->getMessage() . "\n"; }
echo $l->disponible() . "\n";
```
🟢 **Qué mejoró:** el método `asignar()` protege la regla; es imposible quedar en negativo.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
