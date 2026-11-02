# Ejercicio 1 — Descuentos con if/elif

> Lección 14 · refuerzo. Cita (regla 6):  *"for handler in HANDLERS[type(event)]: handler(event)"* — Cap. 8.

**Problema:**
1. Aplicar descuentos a un precio; hoy hay ninguno y 10 %, mañana vip.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function precio(float $base, string $codigo): float {
    if ($codigo === "ninguno") { return $base; }
    elseif ($codigo === "10") { return $base * 0.9; }
    return $base;
}
echo precio(100, "10") . "\n";
```
🔴 **Qué hace mal:** un if/elif que crece: cada descuento nuevo obliga a editar la función.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$descuentos = ["ninguno" => fn(float $p) => $p, "10" => fn(float $p) => $p * 0.9];
function precio(array $d, float $base, string $codigo): float { return $d[$codigo]($base); }
echo precio($descuentos, 100, "10") . "\n";
```
🟢 **Qué mejoró:** un registro código => función; un descuento nuevo es una entrada nueva (OCP).

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
