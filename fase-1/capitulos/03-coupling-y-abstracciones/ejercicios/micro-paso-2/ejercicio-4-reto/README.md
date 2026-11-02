# Ejercicio 4 (opcional) — Reto: `sincronizar` completa edge-to-edge ✍️

> Cap. 3 · micro-paso 2 · refuerzo. Lo resuelves tú.

**Problema:**
1. Escribe `sincronizar($origen, $destino)` que **copie** lo nuevo y **borre** lo que sobra en destino.
2. Pruébala edge-to-edge: crea dos carpetas temporales con `sys_get_temp_dir()`, pon un archivo en
   origen y otro de más en destino, llama a `sincronizar` y comprueba el resultado. Limpia al final.

**Tu turno:**
- Versión mala (todo mezclado en un bucle, sin limpiar) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (reunir → núcleo → aplicar, con carpetas temporales) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
