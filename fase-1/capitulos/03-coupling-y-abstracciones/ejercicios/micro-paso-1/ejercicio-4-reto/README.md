# Ejercicio 4 (opcional) — Reto: decidir "mover" (renombrado) ✍️

> Cap. 3 · micro-paso 1 · refuerzo. Lo resuelves tú.

**Problema:**
1. Escribe un núcleo `determinarAcciones(array $origen, array $destino)` donde la entrada sea
   `hash => nombre`. Si un hash está en los dos pero con **nombre distinto**, la acción es
   `['MOVER', viejo, nuevo]` (no copiar de nuevo).

**Tu turno:**
- Versión mala (compara por nombre y copia duplicados) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (compara por hash y decide MOVER) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
