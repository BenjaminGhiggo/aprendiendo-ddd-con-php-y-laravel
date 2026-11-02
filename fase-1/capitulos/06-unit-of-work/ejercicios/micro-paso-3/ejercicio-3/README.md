# Ejercicio 3 — Confirmar antes de devolver la referencia

> Cap. 6 · micro-paso 3 · refuerzo. Cita (regla 6): *"with uow: ... uow.commit()"* — Cap. 6.

**Problema:**
1. El servicio devuelve la referencia pero olvida `comprometer()`: el cambio se pierde. Confírmalo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Uow { public bool $comprometido = false; public function comprometer(): void { $this->comprometido = true; } }
function asignar(Uow $uow): string { return "lote-1"; /* olvidó $uow->comprometer() */ }
$u = new Uow(); $ref = asignar($u);
echo "ref $ref, confirmado: " . var_export($u->comprometido, true) . "\n"; // false
```
🔴 **Qué hace mal:** devuelve la referencia pero nunca confirma; el cambio no persiste.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Uow { public bool $comprometido = false; public function comprometer(): void { $this->comprometido = true; } }
function asignar(Uow $uow): string { $uow->comprometer(); return "lote-1"; }
$u = new Uow(); $ref = asignar($u);
echo "ref $ref, confirmado: " . var_export($u->comprometido, true) . "\n"; // true
```
🟢 **Qué mejoró:** confirma con `comprometer()` antes de devolver; el cambio queda persistido.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
