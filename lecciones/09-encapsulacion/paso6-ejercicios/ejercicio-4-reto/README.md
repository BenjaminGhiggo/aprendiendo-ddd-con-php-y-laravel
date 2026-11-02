# Ejercicio 4 (opcional) — Reto para ti ✍️

> Lección 09 · refuerzo. Lo resuelves tú.

**Problema:**
1. Crea una clase `CuentaBancaria` con un saldo.
2. Muestra que con el saldo **público** alguien lo deja negativo; luego protégelo.

**Tu turno:**
- Versión mala en [`solucion-mala/main.php`](solucion-mala/main.php) (saldo público).
- Versión buena en [`solucion-buena/main.php`](solucion-buena/main.php) (saldo privado + `retirar()` que valida).

**Comprobar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
