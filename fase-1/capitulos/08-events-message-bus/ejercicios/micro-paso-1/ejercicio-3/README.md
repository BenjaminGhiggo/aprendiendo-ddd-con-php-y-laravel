# Ejercicio 3 — El evento lleva sus datos

> Cap. 8 · micro-paso 1 · refuerzo. Cita (regla 6): *"Events don't have any behavior, because they're pure data structures."* — Cap. 8.

**Problema:**
1. El manejador necesita saber *de qué sku* fue el problema.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): `SinStock` sin datos; el sku se guarda aparte en una variable global.
🔴 **Qué hace mal:** el evento no es autosuficiente; el dato viaja por un canal paralelo y se pierde.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): `SinStock` lleva `readonly string $sku`.
🟢 **Qué mejoró:** el evento carga todo lo necesario para reaccionar; nada viaja por fuera.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
