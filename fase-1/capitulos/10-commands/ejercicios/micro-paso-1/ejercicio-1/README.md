# Ejercicio 1 — Imperativo para órdenes, pasado para hechos

> Cap. 10 · micro-paso 1 · refuerzo. Cita (regla 6): *"We name commands with imperative mood verb phrases"* — Cap. 10.

**Problema:**
1. Nombra el mensaje que pide asignar y el que informa que se asignó.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): un único tipo `Mensaje` con un campo `tipo` string.
🔴 **Qué hace mal:** el `tipo` no distingue orden de hecho; se nota en el nombre, no en el código.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): `Asignar` (imperativo) y `Asignado` (pasado), clases separadas.
🟢 **Qué mejoró:** el nombre y el tipo dicen si es orden o hecho; el compilador los distingue.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
