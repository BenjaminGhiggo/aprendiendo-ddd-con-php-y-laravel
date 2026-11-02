# Ejercicio 2 — El error de un comando PROPAGA

> Cap. 10 · micro-paso 2 · refuerzo. Cita (regla 6): *"If any errors are raised, they fail fast and will bubble up."* — Cap. 10.

**Problema:**
1. Si la orden falla, quien la dio debe enterarse.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): envuelve el comando en `try/catch` y se traga el error.
🔴 **Qué hace mal:** el que dio la orden cree que salió bien; el fallo queda oculto.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): el comando NO se envuelve; el error **burbujea**.
🟢 **Qué mejoró:** el fallo llega a quien pidió la orden y puede reaccionar.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
