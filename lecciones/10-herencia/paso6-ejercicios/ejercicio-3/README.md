# Ejercicio 3 — Distinguir por tipo

> Lección 10 · refuerzo. Cita (regla 6): *"if not isinstance(other, Batch): return False"* — Cap. 1.

**Problema:**
1. Saber si un lote es refrigerado.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Lote { public function __construct(public string $ref, public string $tipo = "normal") {} }
$l = new Lote("l2", "refrigerado");
if ($l->tipo === "refrigerado") { echo "es refrigerado\n"; }  // y si alguien escribe mal el texto?
```
🔴 **Qué hace mal:** compara un campo de texto `tipo`, frágil (un typo lo rompe).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote { public function __construct(public string $ref) {} }
class LoteRefrigerado extends Lote {}
$l = new LoteRefrigerado("l2");
if ($l instanceof LoteRefrigerado) { echo "es refrigerado\n"; }
```
🟢 **Qué mejoró:** `instanceof` distingue por la clase real.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
