# Ejercicio 2 — Cargar el agregado completo (con sus lotes)

> Cap. 7 · micro-paso 2 · refuerzo. Cita (regla 6): *"One Aggregate = One Repository."* — Cap. 7.

**Problema:**
1. Al obtener el producto, debe venir con sus lotes (en Eloquent: `with('lotes')`). Si no, el agregado está incompleto.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$producto = ['sku' => 'MESA']; // sin 'lotes'
echo "lotes cargados: " . count($producto['lotes'] ?? []) . "\n"; // 0 (incompleto)
```
🔴 **Qué hace mal:** carga el producto sin sus lotes; asignar sobre un agregado vacío falla.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$producto = ['sku' => 'MESA', 'lotes' => ['l1', 'l2']];
echo "lotes cargados: " . count($producto['lotes']) . "\n"; // 2 (agregado completo)
```
🟢 **Qué mejoró:** carga el agregado completo (producto + lotes), listo para asignar.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
