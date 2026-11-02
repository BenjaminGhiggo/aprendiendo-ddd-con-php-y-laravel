# Ejercicio 2 — `implements` obliga a cumplir el contrato

> Cap. 2 · micro-paso 1 · refuerzo. Cita (regla 6): *"The simplest repository has just two methods: add() ... and get() ..."* — Cap. 2.

**Problema:**
1. Un repositorio falso debe tener **exactamente** los mismos métodos que el real.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
el falso define `traer()` en vez de `obtener()`; nada avisa que no calza con el contrato.
🔴 **Qué hace mal:** al cambiar al real (`obtener`) el código que llamaba `traer` se rompe.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`implements RepositorioDeLotes` obliga a declarar `obtener()`; si falta, PHP falla al cargar la clase.
🟢 **Qué mejoró:** el contrato garantiza que falso y real son intercambiables.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
