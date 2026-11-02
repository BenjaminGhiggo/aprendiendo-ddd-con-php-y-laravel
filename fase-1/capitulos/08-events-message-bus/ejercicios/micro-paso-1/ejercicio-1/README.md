# Ejercicio 1 — Un evento es una clase de datos

> Cap. 8 · micro-paso 1 · refuerzo. Cita (regla 6): *"Events are simple dataclasses that define the data structures for inputs and internal messages within our system."* — Cap. 8.

**Problema:**
1. Representa "me quedé sin stock del sku MESA" como un evento.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): un string suelto `"SinStock:MESA"` que nadie sabe parsear.
🔴 **Qué hace mal:** el "evento" es texto sin forma; cada lector lo rompe a mano y no hay tipos.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): una clase `SinStock` con `readonly string $sku`.
🟢 **Qué mejoró:** el evento es un dato con forma y tipo; registra *qué pasó* sin ambigüedad.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
