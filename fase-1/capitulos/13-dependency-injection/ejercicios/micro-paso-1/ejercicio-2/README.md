# Ejercicio 2 — Un solo lugar que arma todo (bootstrap)

> Capítulo 13 (Dependency Injection) · micro-paso 1 · refuerzo. Cita: *"declaring an explicit dependency is an example of the dependency inversion principle."* — Cap. 13.

**Problema:**
1. No armes las dependencias en cada entrypoint. Reúnelas en un bootstrap.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Cada entrypoint arma sus dependencias.
🔴 **Qué hace mal:** Montar las dependencias en muchos sitios: cambiar una obliga a tocar todos.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Bootstrap único (composition root).
🟢 **Qué mejoró:** Un composition root: se declara una vez y todos lo reusan.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
