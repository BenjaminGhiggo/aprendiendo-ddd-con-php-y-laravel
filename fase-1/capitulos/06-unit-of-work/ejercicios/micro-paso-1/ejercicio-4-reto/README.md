# Ejercicio 4 (opcional) — Reto: atomicidad con rollback ✍️

> Cap. 6 · micro-paso 1 · refuerzo. Lo resuelves tú.

**Problema:**
1. Escribe una función que acumule varios "guardados" y, si uno lanza una excepción, **deshaga todos** (que no quede nada confirmado).

**Tu turno:**
- Versión mala (confirma lo parcial aunque algo falle) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (todo o nada, con `try`/`catch`) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
