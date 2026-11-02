# Ejercicio 2 — `disponible` se calcula, no se guarda

> Cap. 2 · micro-paso 2 · refuerzo. Cita (regla 6): *"The ORM imports (or "depends on" or "knows about") the domain model ..."* — Cap. 2.

**Problema:**
1. Lo "disponible" de un lote depende de lo comprado y lo asignado. ¿Lo guardo como dato?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
`disponible` se calcula sobre una lista con posibles duplicados; se descuadra.
🔴 **Qué hace mal:** dos fuentes de verdad paralelas que se contradicen.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
las asignaciones van en un array **por clave** (no duplican) y `disponible()` las resta al vuelo.
🟢 **Qué mejoró:** una sola fuente de verdad; disponible siempre cuadra.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
