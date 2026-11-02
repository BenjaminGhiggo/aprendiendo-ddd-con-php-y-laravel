# Ejercicio 3 — El servicio delega en el agregado

> Cap. 7 · micro-paso 2 · refuerzo. Cita (regla 6): *"we can move the allocate() domain service to be a method on the Product aggregate."* — Cap. 7.

**Problema:**
1. El servicio no debe ordenar lotes ni validar stock a mano: eso vive en el agregado. El servicio solo orquesta.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function servicioAsignar(array $lotes, int $cantidad): string {
    usort($lotes, fn($a, $b) => $a['disponible'] <=> $b['disponible']); // negocio en el servicio
    foreach ($lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
    return "";
}
echo servicioAsignar([['ref' => 'l1', 'disponible' => 100]], 10) . "\n";
```
🔴 **Qué hace mal:** el negocio (ordenar, elegir) vive en el servicio; se repite y se desincroniza del agregado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Producto {
    public function __construct(public array $lotes) {}
    public function asignar(int $cantidad): string {
        foreach ($this->lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
        throw new \RuntimeException("Sin stock");
    }
}
function servicioAsignar(Producto $p, int $cantidad): string { return $p->asignar($cantidad); }
echo servicioAsignar(new Producto([['ref' => 'l1', 'disponible' => 100]]), 10) . "\n";
```
🟢 **Qué mejoró:** el servicio delega en el agregado; solo orquesta (obtener → asignar → comprometer).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
