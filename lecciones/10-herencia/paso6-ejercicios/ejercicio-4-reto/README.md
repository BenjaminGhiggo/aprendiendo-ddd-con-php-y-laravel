# Ejercicio 4 (opcional) — Reto para ti ✍️

> Lección 10 · refuerzo. Lo resuelves tú.

**Problema:**
1. Crea una clase base `Figura` con un método `describir()`.
2. Crea `Cuadrado extends Figura` que reutilice `parent::describir()`.

**Tu turno:**
- Versión mala en [`solucion-mala/main.php`](solucion-mala/main.php) (duplicar).
- Versión buena en [`solucion-buena/main.php`](solucion-buena/main.php) (`extends` + `parent::`).

**Comprobar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
