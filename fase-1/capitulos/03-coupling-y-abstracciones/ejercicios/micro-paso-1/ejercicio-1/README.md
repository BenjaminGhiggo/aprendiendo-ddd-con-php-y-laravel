# Ejercicio 1 — Separar la decisión del I/O

> Cap. 3 · micro-paso 1 · refuerzo. Cita (regla 6): *"our domain logic ... is tightly coupled to the I/O code."* — Cap. 3.

**Problema:**
1. Una función decide qué copiar **y** copia, todo en el mismo bucle.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
`scandir` + `copy` entrelazados; probar la decisión exige archivos reales.
🔴 **Qué hace mal:** lógica y disco pegados; el test es lento y frágil.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`determinarAcciones(array, array)` **solo decide** y devuelve una lista; cero I/O.
🟢 **Qué mejoró:** se prueba con un array de entrada y se compara la salida.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
