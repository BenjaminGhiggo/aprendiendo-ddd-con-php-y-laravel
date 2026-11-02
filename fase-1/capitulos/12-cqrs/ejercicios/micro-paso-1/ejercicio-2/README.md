# Ejercicio 2 — El POST responde un OK simple

> Capítulo 12 (CQRS) · micro-paso 1 · refuerzo. Cita: *"functions should either modify state or answer questions, but never both."* — Cap. 12.

**Problema:**
1. El endpoint de asignar debe responder un OK (202), no la referencia del lote.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): POST que devuelve el dato de dominio.
🔴 **Qué hace mal:** Devolver datos desde el POST invita a reenviarlo (Post/Redirect/Get roto).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): POST que devuelve solo OK.
🟢 **Qué mejoró:** El POST solo confirma; la lectura va por un GET separado (Post/Redirect/Get).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
