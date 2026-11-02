# Ejercicio 4 (opcional) — Reto para ti ✍️

> Lección 17 · refuerzo (DIP). Lo resuelves tú.

**Problema:**
1. Una función que registra un usuario y lo guarda en un "repositorio".
2. Debe poder probarse con un repositorio falso.

**Tu turno:**
- Versión mala en [`solucion-mala/main.php`](solucion-mala/main.php) (la función crea el repositorio adentro).
- Versión buena en [`solucion-buena/main.php`](solucion-buena/main.php) (el repositorio se inyecta).

**Para compararlas** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
