# Ejercicio 3 — Un evento, varios handlers

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 1 · refuerzo. Cita: *"Temporal Decoupling Using Asynchronous Messaging."* — Cap. 11.

**Problema:**
1. El evento interno Asignado dispara DOS handlers: uno interno (registrar) y otro que
   publica al exterior.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Un solo handler que mezcla todo.
🔴 **Qué hace mal:** Mezclar responsabilidades: no puedes activar/desactivar la publicación externa sola.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Dos handlers independientes para el mismo evento.
🟢 **Qué mejoró:** Cada handler una responsabilidad; añadir/quitar uno no toca al otro.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
