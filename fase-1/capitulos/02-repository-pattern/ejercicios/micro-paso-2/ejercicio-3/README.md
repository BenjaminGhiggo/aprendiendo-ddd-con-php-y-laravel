# Ejercicio 3 — Comparar por identidad (`equals`)

> Cap. 2 · micro-paso 2 · refuerzo. Cita (regla 6): *"The ORM imports (or "depends on" or "knows about") the domain model ..."* — Cap. 2.

**Problema:**
1. Dos cargas del **mismo** lote (misma referencia) tienen stock distinto. ¿Son el mismo lote?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
compara con `==`, que mira todos los campos; da `false` aunque sea el mismo lote.
🔴 **Qué hace mal:** una entidad no se compara por todos sus datos, sino por su identidad.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`equals()` compara solo la **referencia** (la identidad de la entidad).
🟢 **Qué mejoró:** mismo lote = misma referencia, cambie o no su stock.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
