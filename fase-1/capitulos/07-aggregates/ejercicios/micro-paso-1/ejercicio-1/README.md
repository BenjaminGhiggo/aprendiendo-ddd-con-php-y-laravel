# Ejercicio 1 — Asignar sube el `numero_version`

> Cap. 7 · micro-paso 1 · refuerzo. Cita (regla 6): *"self.version_number += 1"* — Cap. 7.

**Problema:**
1. Al asignar debe subir el número de versión del producto (concurrencia optimista). Hazlo pasar por el agregado.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$lote = ['referencia' => 'l1', 'disponible' => 100];
$lote['disponible'] -= 10;         // asignamos directo al lote
$version = 0;                       // ...y la version del producto se queda en 0
echo "disponible={$lote['disponible']} version=$version\n"; // version=0 (no detecta el cambio)
```
🔴 **Qué hace mal:** se toca el lote suelto; nadie sube la versión, así que no hay forma de detectar cambios concurrentes.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Producto {
    public int $numeroVersion = 0;
    public function __construct(public int $disponible) {}
    public function asignar(int $cantidad): void { $this->disponible -= $cantidad; $this->numeroVersion++; }
}
$p = new Producto(100);
$p->asignar(10);
echo "disponible={$p->disponible} version={$p->numeroVersion}\n"; // version=1
```
🟢 **Qué mejoró:** la asignación pasa por el agregado, que sube `numeroVersion` en cada cambio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
