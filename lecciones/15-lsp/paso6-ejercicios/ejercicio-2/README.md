# Ejercicio 2 — El pingüino que no vuela

> Lección 15 · refuerzo.

**Problema:**
1. Modelar aves; no todas vuelan.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Ave { public function volar(): string { return "vuela"; } }
class Pinguino extends Ave { public function volar(): string { throw new \Exception("no puedo volar"); } }
try { echo (new Pinguino())->volar() . "\n"; } catch (\Exception $e) { echo "sorpresa: " . $e->getMessage() . "\n"; }
```
🔴 **Qué hace mal:** la hija lanza un error que la madre no lanzaba (LS5).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Ave { public function comer(): string { return "come"; } }
class AveVoladora extends Ave { public function volar(): string { return "vuela"; } }
$pinguino = new Ave(); echo $pinguino->comer() . " (no hereda volar, no sorprende)\n";
```
🟢 **Qué mejoró:** separar la jerarquía: solo las aves voladoras tienen volar().

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
