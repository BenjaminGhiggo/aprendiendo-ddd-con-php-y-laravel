# Ejercicio 2 — No llames al otro servicio directamente

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 1 · refuerzo. Cita: *"Temporal Decoupling Using Asynchronous Messaging."* — Cap. 11.

**Problema:**
1. Al asignar, avisa a envíos. No lo llames directo: publica un evento y que él escuche.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Llamada directa al otro servicio.
🔴 **Qué hace mal:** Si Envios falla o cambia, tu asignación se rompe; no puedes desplegar por separado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Publicar un evento; el otro escucha.
🟢 **Qué mejoró:** El dominio no conoce a Envios; publica y sigue. Servicios independientes.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
