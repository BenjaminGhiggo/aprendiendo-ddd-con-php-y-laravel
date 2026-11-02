# Ejercicio 3 — El bus reparte por `instanceof`

> Cap. 10 · micro-paso 1 · refuerzo. Cita (regla 6): *"They express our wish for the system to do something."* — Cap. 10.

**Problema:**
1. El bus recibe un mensaje y debe mandarlo a la rama de comandos o a la de eventos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): decide leyendo un campo `tipo` string.
🔴 **Qué hace mal:** un `tipo` mal escrito manda el mensaje a la rama equivocada sin avisar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): decide con `instanceof Comando`.
🟢 **Qué mejoró:** el reparto se basa en el tipo real del objeto, no en un texto.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
