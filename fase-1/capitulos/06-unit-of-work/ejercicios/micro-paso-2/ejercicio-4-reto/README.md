# Ejercicio 4 (opcional) — Reto: `comprometer()` vuelve a abrir transacción ✍️

> Cap. 6 · micro-paso 2 · refuerzo. Lo resuelves tú.

**Problema:**
1. En la UoW real, tras `comprometer()` (que hace `commit`) debe quedar una transacción abierta para que el `finally` de `ejecutar` siempre tenga algo que deshacer. Simúlalo con mensajes.

**Tu turno:**
- Versión mala (`comprometer` hace `commit` y deja la conexión sin transacción) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (`comprometer` hace `commit` y luego `beginTransaction`) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
