# Ejercicio 4 (opcional) — Reto: `agregarLote` dentro de la UoW ✍️

> Cap. 6 · micro-paso 3 · refuerzo. Lo resuelves tú.

**Problema:**
1. Escribe un servicio `agregarLote` que, dentro de `uow->ejecutar(...)`, agregue un lote al repositorio de la UoW y luego `comprometer()`.

**Tu turno:**
- Versión mala (agrega al repo pero fuera de `ejecutar` y sin confirmar) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (todo dentro de `ejecutar` y confirma) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
