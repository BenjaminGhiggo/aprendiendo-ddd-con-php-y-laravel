# Ejercicio 2 — Cambiar de canal en una línea

> Capítulo 13 (Dependency Injection) · micro-paso 2 · refuerzo. Cita: *"1. Define your API using an ABC. 2. Implement the real thing. 3. Build a fake and use it for ... tests."* — Cap. 13.

**Problema:**
1. Añade una implementación SMS. Cambiar email->SMS debe ser una línea (el bootstrap).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Cambiar de canal obliga a tocar el código de negocio.
🔴 **Qué hace mal:** El canal está incrustado; migrar a SMS obliga a editar la lógica.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Cambiar la implementación ligada.
🟢 **Qué mejoró:** El negocio no cambia; eliges el canal en un solo sitio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
