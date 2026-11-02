# Ejercicio 2 — Recibir datos, no leer el disco

> Cap. 3 · micro-paso 1 · refuerzo. Cita (regla 6): *"our domain logic ... is tightly coupled to the I/O code."* — Cap. 3.

**Problema:**
1. "Qué hay que borrar" se calcula leyendo la carpeta destino por dentro.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
`hayQueBorrar` esconde un `scandir`; necesita una carpeta real para probarse.
🔴 **Qué hace mal:** el I/O escondido vuelve la función difícil de testear.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
recibe los nombres como **arrays**; decide sin tocar el disco.
🟢 **Qué mejoró:** datos → datos; test trivial.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
