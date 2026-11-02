# Ejercicio 3 — No repetir la transacción en cada caso de uso

> Cap. 6 · micro-paso 1 · refuerzo. Cita (regla 6): *"the Unit of Work (UoW) pattern is our abstraction over the idea of atomic operations."* — Cap. 6.

**Problema:**
1. Dos casos de uso repiten `commit`/`rollback` a mano; uno se olvida del commit. Centralízalo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function casoUso1(): void { echo "abrir; guardar; commit\n"; }
function casoUso2(): void { echo "abrir; guardar\n"; } // ¡se olvidó el commit!
casoUso1(); casoUso2();
```
🔴 **Qué hace mal:** la transacción se copia en cada caso de uso; es fácil olvidarla.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function conUow(callable $trabajo): void { echo "abrir; "; $trabajo(); echo "cerrar\n"; }
conUow(fn() => print("guardar; commit "));
conUow(fn() => print("guardar; commit "));
```
🟢 **Qué mejoró:** la transacción vive en UN solo lugar (la UoW); los casos de uso no la repiten.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
