# Ejercicio 2 — Dos jerarquías: `Comando` y `Evento`

> Cap. 10 · micro-paso 1 · refuerzo. Cita (regla 6): *"Commands capture intent."* — Cap. 10.

**Problema:**
1. El bus debe poder preguntar "¿esto es una orden o un hecho?".

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): todo hereda de un único `Mensaje`.
🔴 **Qué hace mal:** no hay forma de preguntar por el tipo salvo mirar un campo string.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): `Comando` y `Evento` como bases distintas; `instanceof` responde.
🟢 **Qué mejoró:** `instanceof Comando` separa órdenes de hechos sin leer campos.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
