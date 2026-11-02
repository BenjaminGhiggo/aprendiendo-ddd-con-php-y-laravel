# Ejercicio 1 — Una cola, no una pasada única

> Cap. 9 · micro-paso 1 · refuerzo. Cita (regla 6): *"After each handler finishes, we collect any new events that have been generated and add them to the queue."* — Cap. 9.

**Problema:**
1. Un manejador puede generar un evento nuevo que también debe procesarse (cascada).

**Solución mala (funciona a medias)** — [`solucion-mala/main.php`](solucion-mala/main.php): recorre la lista inicial **una vez**; los eventos nuevos se pierden.
🔴 **Qué hace mal:** si un handler produce otro evento, nadie lo procesa.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): una **cola** (`while`), y lo nuevo se **encola**.
🟢 **Qué mejoró:** la reacción encadena a la siguiente hasta vaciar la cola.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
