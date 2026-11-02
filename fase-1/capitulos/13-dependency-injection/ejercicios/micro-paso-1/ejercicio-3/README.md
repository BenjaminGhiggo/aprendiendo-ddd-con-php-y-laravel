# Ejercicio 3 — El contenedor liga interfaz a implementación

> Capítulo 13 (Dependency Injection) · micro-paso 1 · refuerzo. Cita: *"declaring an explicit dependency is an example of the dependency inversion principle."* — Cap. 13.

**Problema:**
1. Usa el contenedor de Laravel: liga la interfaz a una implementación y pídela por la interfaz.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Instanciar la clase concreta a mano.
🔴 **Qué hace mal:** Pides el detalle concreto; cambiar de implementación obliga a buscar cada `new`.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Contenedor resuelve por la interfaz.
🟢 **Qué mejoró:** Pides la abstracción; el contenedor da la implementación ligada (cambiable en un sitio).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
