# Ejercicio 1 — Producto y su precio

> Lección 05 · refuerzo. Cita (regla 6): *"HANDLERS = { events.OutOfStock: [send_out_of_stock_notification], }"* — Cap. 8.

**Problema:**
1. Guarda productos y sus precios, y muestra cuánto cuesta la silla.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$productos = ["mesa", "silla", "lampara"];
$precios = [100, 50, 30];
echo $productos[1] . " cuesta " . $precios[1] . "\n";
```
🔴 **Qué hace mal:** usa **dos arrays paralelos** que hay que mantener sincronizados por posición.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$precios = ["mesa" => 100, "silla" => 50, "lampara" => 30];
echo "silla cuesta " . $precios["silla"] . "\n";
```
🟢 **Qué mejoró:** un array asociativo une producto y precio en un solo lugar; se consulta por nombre.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
