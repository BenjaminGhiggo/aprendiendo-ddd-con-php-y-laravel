# Ejercicio 1 — Cáscara que solo orquesta

> Cap. 3 · micro-paso 2 · refuerzo. Cita (regla 6): *"our top-level function will contain almost no logic at all; it's just an imperative series of steps: gather inputs, call our logic, apply outputs."* — Cap. 3.

**Problema:**
1. La función de arriba mezcla reunir, decidir y aplicar en un solo bucle.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
`scandir` + decisión + `copy` entrelazados; no se puede probar la decisión sola.
🔴 **Qué hace mal:** la cáscara tiene lógica; nada queda aislado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`sincronizar` = reunir (`nombres`) → decidir (`determinarAcciones`) → aplicar (`copy`).
🟢 **Qué mejoró:** la cáscara solo orquesta; la lógica vive en el núcleo.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
