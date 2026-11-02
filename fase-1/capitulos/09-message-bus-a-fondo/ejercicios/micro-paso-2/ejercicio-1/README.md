# Ejercicio 1 — No dejar disponible negativo

> Cap. 9 · micro-paso 2 · refuerzo. Cita (regla 6): *"Example 2: Change Batch Quantity"* — Cap. 9.

**Problema:**
1. Bajas la cantidad comprada de un lote por debajo de lo ya asignado.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): cambia la cantidad y deja `disponible` en negativo.
🔴 **Qué hace mal:** el lote queda inconsistente (prometió más de lo que tiene).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): desasigna líneas hasta que `disponible >= 0`.
🟢 **Qué mejoró:** el agregado vuelve a un estado consistente; lo desasignado se reasignará.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
