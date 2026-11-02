# Ejercicio 4 (opcional) — Reto: un servicio probado con el falso ✍️

> Cap. 2 · micro-paso 3 · refuerzo. Lo resuelves tú.

**Problema:**
1. Escribe `function asignarStock(RepositorioDeLotes $repo, string $ref): int` que devuelva el stock o 0.
2. Pruébala con un `RepositorioFalso` en memoria usando `assert`, sin ninguna base de datos.

**Tu turno:**
- Versión mala (el servicio crea la BD por dentro) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (recibe la interfaz; test con el falso) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
