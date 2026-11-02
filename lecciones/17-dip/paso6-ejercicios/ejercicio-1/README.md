# Ejercicio 1 — No crear la base de datos adentro

> Lección 17 · refuerzo (DIP). Cita (regla 6): *"High-level modules should not depend
> on low-level modules."* — Introducción.

**Problema:**
1. Una función `registrar($dato)` que guarda en algún almacenamiento.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function registrar(string $dato): void {
    $db = new BaseDeDatos();   // crea el detalle concreto adentro
    $db->guardar($dato);
}
```
🔴 **Qué hace mal:** el alto nivel (`registrar`) depende de una clase concreta. No se puede
probar sin una base real ni cambiar de almacenamiento sin tocar la función.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function registrar(Almacen $almacen, string $dato): void {
    $almacen->guardar($dato);
}
registrar(new BaseDeDatos(), "L1");
registrar(new AlmacenFalso(), "L1");
```
🟢 **Qué mejoró:** el almacenamiento se **inyecta**. `registrar` no sabe cuál es; se le pasa
el real o uno falso para probar.

**Ver la mejora línea por línea** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
