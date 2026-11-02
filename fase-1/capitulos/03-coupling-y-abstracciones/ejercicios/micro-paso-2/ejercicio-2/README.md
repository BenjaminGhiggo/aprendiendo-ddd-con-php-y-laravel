# Ejercicio 2 — Test edge-to-edge con carpeta temporal

> Cap. 3 · micro-paso 2 · refuerzo. Cita (regla 6): *"our top-level function ... gather inputs, call our logic, apply outputs."* — Cap. 3.

**Problema:**
1. Un test de I/O real debe usar archivos sin ensuciar el repo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
crea una carpeta `basura/` fija dentro del proyecto y no limpia.
🔴 **Qué hace mal:** deja restos en el repo y dos tests chocan.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`sys_get_temp_dir() . '/sync_' . uniqid()`; borra todo al final.
🟢 **Qué mejoró:** carpeta única del sistema, sin rastro.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
