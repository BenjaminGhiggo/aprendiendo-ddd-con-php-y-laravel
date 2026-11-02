# Ejercicio 3 — Broker en memoria para los tests

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 2 · refuerzo. Cita: *"Redis Is Another Thin Adapter Around Our Message Bus."* — Cap. 11.

**Problema:**
1. En los tests no hay Redis. Simula el canal con un broker en memoria que puedas inspeccionar.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Depender de Redis real en el test.
🔴 **Qué hace mal:** El test depende de infraestructura externa; no corre en cualquier máquina.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Broker simulado inspeccionable.
🟢 **Qué mejoró:** Sin infraestructura: publicas y compruebas el array. Rápido y reproducible.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
