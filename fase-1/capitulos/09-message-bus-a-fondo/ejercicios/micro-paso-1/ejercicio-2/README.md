# Ejercicio 2 — Recolectar tras CADA handler

> Cap. 9 · micro-paso 1 · refuerzo. Cita (regla 6): *"The message bus passes the UoW down to each handler. After each handler finishes, we collect any new events that have been generated and add them to the queue."* — Cap. 9.

**Problema:**
1. ¿Cuándo recoge el bus los eventos nuevos que acumuló el modelo?

**Solución mala (funciona a medias)** — [`solucion-mala/main.php`](solucion-mala/main.php): recoge solo **al final**, cuando ya terminó todo.
🔴 **Qué hace mal:** un evento generado a mitad no entra en la cascada a tiempo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): recoge **después de cada handler** y encola.
🟢 **Qué mejoró:** cada reacción puede disparar la siguiente de inmediato.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
