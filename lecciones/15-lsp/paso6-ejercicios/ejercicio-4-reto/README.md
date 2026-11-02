# Ejercicio 4 (opcional) — Reto para ti ✍️

> Lección 15 · refuerzo. Lo resuelves tú.

**Problema:**
1. Una cuenta de ahorro que hereda de Cuenta y rompe retirar().

**Tu turno:**
- Versión mala en [`solucion-mala/main.php`](solucion-mala/main.php) (una hija que rompe el contrato).
- Versión buena en [`solucion-buena/main.php`](solucion-buena/main.php) (separar Cuenta y CuentaConRetiro como hermanas/capas).

**Para compararlas** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
