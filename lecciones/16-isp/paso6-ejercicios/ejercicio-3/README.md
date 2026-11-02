# Ejercicio 3 — Trabajar y cobrar no siempre van juntos

> Lección 16 · refuerzo (ISP).

**Problema:**
1. Empleados (trabajan y cobran) y voluntarios (solo trabajan).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
interface Trabajador {
    public function trabajar(): string;
    public function cobrarSueldo(): string;
}
```
🔴 **Qué hace mal:** `Voluntario` se ve obligado a implementar `cobrarSueldo`, aunque no
cobra, y tiene que lanzar una excepción "no aplica".

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
interface Trabaja { public function trabajar(): string; }
interface Cobra   { public function cobrarSueldo(): string; }
```
🟢 **Qué mejoró:** se separan las capacidades. El voluntario implementa solo `Trabaja`;
el empleado, `Trabaja` y `Cobra`.

**Ver la mejora línea por línea** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
