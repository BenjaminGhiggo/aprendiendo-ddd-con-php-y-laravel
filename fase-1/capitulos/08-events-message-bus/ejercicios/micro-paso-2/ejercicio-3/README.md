# Ejercicio 3 — Varios manejadores por evento

> Cap. 8 · micro-paso 2 · refuerzo. Cita (regla 6): *"HANDLERS ... : [send_out_of_stock_notification],"* (el valor es una **lista**). — Cap. 8.

**Problema:**
1. Un mismo evento puede necesitar varias reacciones (notificar Y apuntar en un log).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): el mapa guarda **un** manejador por evento.
🔴 **Qué hace mal:** para una segunda reacción hay que cambiar la firma del mapa o encadenar dentro del handler.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): el valor es una **lista** de manejadores; el `foreach` los llama a todos.
🟢 **Qué mejoró:** añadir una reacción es añadir un elemento a la lista; nada más cambia.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
