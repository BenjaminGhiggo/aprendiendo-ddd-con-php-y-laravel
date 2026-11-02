# Ejercicio 1 — if/elseif en vez de tres if

> condicionales · Lección 02 · refuerzo. Cita (regla 6): *"return self.sku == line.sku and self.available_quantity >= line.qty"* — Cap. 1.

**Problema:**
1. Clasifica una edad en menor / adulto / adulto mayor.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$edad = 30; $resultado = "";
if ($edad < 18) { $resultado = "menor"; }
if ($edad >= 18 && $edad < 65) { $resultado = "adulto"; }
if ($edad >= 65) { $resultado = "adulto mayor"; }
echo "$resultado\n";
```
🔴 **Qué hace mal:** tres `if` separados; PHP evalúa todos aunque uno ya acertó.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$edad = 30;
if ($edad < 18) { $resultado = "menor"; }
elseif ($edad < 65) { $resultado = "adulto"; }
else { $resultado = "adulto mayor"; }
echo "$resultado\n";
```
🟢 **Qué mejoró:** `if/elseif/else` se detiene en cuanto uno acierta.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
