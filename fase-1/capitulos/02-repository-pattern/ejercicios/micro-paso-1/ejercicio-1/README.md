# Ejercicio 1 — Depender de un contrato, no de la BD

> Cap. 2 · micro-paso 1 · refuerzo. Cita (regla 6): *"The simplest repository has just two methods: add() ... and get() ..."* — Cap. 2.

**Problema:**
1. Un servicio necesita el stock de un lote. No debería exigir una base de datos real para probarse.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
el servicio consulta la BD directamente, así que no se puede probar sin una.
🔴 **Qué hace mal:** el dominio queda atado a la base de datos; el test necesita MySQL.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
una `interface RepositorioDeLotes`; el servicio depende del **contrato**, y un `RepositorioFalso` en memoria lo satisface.
🟢 **Qué mejoró:** se prueba con un array en memoria, sin base de datos.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
