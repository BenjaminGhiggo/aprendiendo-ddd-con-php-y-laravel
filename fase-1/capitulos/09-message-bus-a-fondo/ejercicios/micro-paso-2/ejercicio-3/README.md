# Ejercicio 3 — Que reasigne el bus, no tú a mano

> Cap. 9 · micro-paso 2 · refuerzo. Cita (regla 6): *"The message bus is now the main entrypoint to the service layer"* — Cap. 9.

**Problema:**
1. Tras desasignar, ¿quién vuelve a asignar las líneas?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): el mismo método que baja la cantidad reasigna a mano.
🔴 **Qué hace mal:** mezcla dos responsabilidades y duplica la lógica de asignar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): solo emite `AsignacionRequerida`; el bus (la cola) lo reasigna con el handler `asignar`.
🟢 **Qué mejoró:** una sola lógica de asignar, reutilizada vía la cascada del bus.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
