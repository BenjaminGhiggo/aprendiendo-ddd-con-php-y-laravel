# Ejercicio 3 — Cambiar el motor sin tocar el dominio

> Capítulo 12 (CQRS) · micro-paso 2 · refuerzo. Cita: *"Updating a Read Model Table Using an Event Handler."* — Cap. 12.

**Problema:**
1. El modelo de lectura podría ser un array, SQLite o Redis. El dominio no debe enterarse.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): El dominio escribe directo en el motor concreto.
🔴 **Qué hace mal:** El dominio depende del motor de lectura; migrar de almacén lo rompe.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Un handler intercambiable detrás del evento.
🟢 **Qué mejoró:** El dominio solo emite el evento; el motor de lectura se cambia en el handler.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
