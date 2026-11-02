# Ejercicio 3 — El código de lectura, aparte

> Capítulo 12 (CQRS) · micro-paso 1 · refuerzo. Cita: *"functions should either modify state or answer questions, but never both."* — Cap. 12.

**Problema:**
1. Reúne las consultas de solo-lectura en un sitio separado de los handlers que escriben.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Lectura mezclada con el handler de escritura.
🔴 **Qué hace mal:** Escritura y lectura en la misma clase: difícil de optimizar u obtener por separado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Una clase Vistas solo-lectura.
🟢 **Qué mejoró:** Las consultas en un solo lugar; el lado de escritura queda limpio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
