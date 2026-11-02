# Ejercicio 4 (opcional) — Reto: inyecta la UoW en un handler ✍️

> Capítulo 13 (Dependency Injection) · micro-paso 1 · refuerzo. Lo resuelves tú.

**Problema:**
1. Haz que un handler reciba la UoW como dependencia explícita y móntala en un bootstrap.
- Versión mala (el handler crea la UoW dentro) en `solucion-mala/main.php`.
- Versión buena (bootstrap la inyecta) en `solucion-buena/main.php`.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
