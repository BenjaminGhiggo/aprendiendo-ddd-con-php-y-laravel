# Ejercicio 1 — Agrupar los datos en una clase

> Cap. 2 · micro-paso 2 · refuerzo. Cita (regla 6): *"The ORM imports (or "depends on" or "knows about") the domain model, and not the other way around."* — Cap. 2.

**Problema:**
1. Los datos de un lote (referencia, sku, cantidad) andan sueltos en variables.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
tres variables sueltas; no hay nada que "sepa guardarse".
🔴 **Qué hace mal:** persistir eso obliga a repetir el mismo código por todos lados.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
una clase `Lote` agrupa los campos (con Eloquent, además heredaría `->save()`).
🟢 **Qué mejoró:** un solo objeto lleva sus datos; el repositorio sabe guardarlo entero.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
