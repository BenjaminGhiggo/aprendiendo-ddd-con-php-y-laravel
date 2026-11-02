# Ejercicio 4 (opcional) — Reto: consume un mensaje externo y cambia el stock ✍️

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 2 · refuerzo. Lo resuelves tú.

**Problema:**
1. Dado un mensaje externo {ref, cantidad}, conviértelo en comando CambiarCantidadLote
   y aplícalo a un lote en memoria.
- Versión mala (el adaptador cambia el stock él mismo) en `solucion-mala/main.php`.
- Versión buena (adaptador fino → comando → handler) en `solucion-buena/main.php`.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
