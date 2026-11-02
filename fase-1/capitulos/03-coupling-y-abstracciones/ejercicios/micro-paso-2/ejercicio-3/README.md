# Ejercicio 3 — Indexar por contenido (hash), no por nombre

> Cap. 3 · micro-paso 2 · refuerzo. Cita (regla 6): *"our top-level function ... gather inputs, call our logic, apply outputs."* — Cap. 3.

**Problema:**
1. Al reunir los datos del disco, ¿cómo detecto que un archivo solo cambió de nombre?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
compara solo por nombre; un archivo renombrado parece "nuevo" y se duplica.
🔴 **Qué hace mal:** ignora el contenido; copia de más.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`hash_file('sha1', ...)` como clave: mismo contenido = misma clave (es un renombre).
🟢 **Qué mejoró:** el hash distingue "mover" de "copiar".

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
