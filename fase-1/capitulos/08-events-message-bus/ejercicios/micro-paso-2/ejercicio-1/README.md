# Ejercicio 1 — Un mapa, no una escalera de `if`

> Cap. 8 · micro-paso 2 · refuerzo. Cita (regla 6): *"HANDLERS = { events.OutOfStock: [send_out_of_stock_notification], }"* — Cap. 8.

**Problema:**
1. Despacha cada evento a su manejador sin un `if` por tipo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): `if ($e instanceof SinStock) {...} elseif (...)`.
🔴 **Qué hace mal:** cada evento nuevo obliga a tocar la escalera de `if`; no es extensible.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): un array `[SinStock::class => [...]]` y un `foreach`.
🟢 **Qué mejoró:** añadir un evento es añadir una entrada al mapa; el `foreach` no cambia.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
