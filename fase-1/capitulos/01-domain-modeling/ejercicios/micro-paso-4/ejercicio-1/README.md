# Ejercicio 1 — Servicio de dominio

> Cap. 1 · micro-paso 4 · refuerzo. Cita (regla 6): *"just make it a function."* — Cap. 1.

**Problema:**
1. Elegir entre varios lotes cuál asignar.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Lote {
    public function __construct(public string $ref, public int $disponible) {}
    public function asignarEntre(array $otros): string {
        foreach ($otros as $l) { if ($l->disponible >= 10) return $l->ref; }
        return "ninguno";
    }
}
$a = new Lote("a", 5);
echo $a->asignarEntre([$a, new Lote("b", 100)]) . "\n";
```
🔴 **Qué hace mal:** mete 'elegir entre lotes' como método de un `Lote`.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Lote { public function __construct(public string $ref, public int $disponible) {} }
function asignar(int $cantidad, array $lotes): string {
    foreach ($lotes as $lote) { if ($lote->disponible >= $cantidad) return $lote->ref; }
    return "ninguno";
}
echo asignar(10, [new Lote("a", 5), new Lote("b", 100)]) . "\n"; // b
```
🟢 **Qué mejoró:** es una función (servicio de dominio), no un método.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
