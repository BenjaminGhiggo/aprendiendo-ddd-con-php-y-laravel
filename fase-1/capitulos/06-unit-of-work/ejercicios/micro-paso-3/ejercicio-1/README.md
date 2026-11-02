# Ejercicio 1 — El servicio pide la UoW, no maneja la transacción

> Cap. 6 · micro-paso 3 · refuerzo. Cita (regla 6): *"with uow:"* — Cap. 6 (los servicios usan la UoW).

**Problema:**
1. El servicio abre y cierra la transacción él mismo (mezcla negocio y persistencia). Que la delegue a la UoW.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function asignar(): void { echo "begin; validar; asignar; commit\n"; }
asignar();
```
🔴 **Qué hace mal:** el servicio mezcla la transacción con el negocio.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function asignar(callable $uowEjecutar): void { $uowEjecutar(fn() => print("validar; asignar; comprometer\n")); }
$uowEjecutar = function (callable $t) { echo "begin; "; $t(); echo "rollback-sobrante\n"; };
asignar($uowEjecutar);
```
🟢 **Qué mejoró:** la transacción vive en la UoW; el servicio solo hace negocio dentro de `ejecutar`.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
