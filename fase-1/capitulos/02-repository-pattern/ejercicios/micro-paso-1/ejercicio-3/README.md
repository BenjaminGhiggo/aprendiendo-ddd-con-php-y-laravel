# Ejercicio 3 — `obtener` devuelve `null`, no revienta

> Cap. 2 · micro-paso 1 · refuerzo. Cita (regla 6): *"The simplest repository has just two methods: add() ... and get() ..."* — Cap. 2.

**Problema:**
1. ¿Qué pasa cuando se pide una referencia que no existe?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
`obtener(): int` lee `$this->stock[$ref]` y lanza `Warning: Undefined array key` + `TypeError` si falta.
🔴 **Qué hace mal:** el que llama no esperaba una excepción; el fallo explota lejos del origen.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`obtener(): ?int` devuelve `null` con el operador `??`; el que llama decide qué hacer.
🟢 **Qué mejoró:** "no existe" es un valor normal (`null`), no un error.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
