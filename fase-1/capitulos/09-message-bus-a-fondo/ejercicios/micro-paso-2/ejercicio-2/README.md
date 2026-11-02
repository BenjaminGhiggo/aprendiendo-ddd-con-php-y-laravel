# Ejercicio 2 — Un evento por cada línea que sobra

> Cap. 9 · micro-paso 2 · refuerzo. Cita (regla 6): *"After each handler finishes, we collect any new events that have been generated and add them to the queue."* — Cap. 9.

**Problema:**
1. Las líneas desasignadas no pueden perderse: hay que volver a intentar asignarlas.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): desasigna pero no deja rastro.
🔴 **Qué hace mal:** la línea desaparece; nadie la reasigna.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): registra un `AsignacionRequerida` por cada línea desasignada.
🟢 **Qué mejoró:** el bus tomará esos eventos y reasignará (cascada).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
