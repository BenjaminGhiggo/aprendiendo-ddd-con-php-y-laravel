# Ejercicio 1 — Recibe la dependencia, no la crees

> Capítulo 13 (Dependency Injection) · micro-paso 1 · refuerzo. Cita: *"declaring an explicit dependency is an example of the dependency inversion principle."* — Cap. 13.

**Problema:**
1. Un handler que notifica 'sin stock' no debe crear el email dentro: recíbelo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Dependencia implícita (creada dentro).
🔴 **Qué hace mal:** Atado a Email; para testear habría que interceptar la creación interna.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Dependencia explícita (recibida).
🟢 **Qué mejoró:** Depende de la abstracción (DIP); en test se pasa una falsa.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
