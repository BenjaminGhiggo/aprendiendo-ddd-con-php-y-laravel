# Ejercicio 2 — Registrar, no ejecutar

> Cap. 8 · micro-paso 1 · refuerzo. Cita (regla 6): *"Rather than invoking some email-sending code directly, we record those events at the place they occur"* — Cap. 8.

**Problema:**
1. Al no poder asignar, el modelo debe dejar constancia, sin mandar el email él mismo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): `asignar()` hace `echo "enviando email..."` dentro.
🔴 **Qué hace mal:** mezcla la regla del negocio (asignar) con un detalle de infraestructura (notificar).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): `asignar()` acumula `$this->eventos[] = new SinStock(...)`.
🟢 **Qué mejoró:** el modelo solo registra *qué pasó*; quién reacciona se decide fuera.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
