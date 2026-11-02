# Ejercicio 2 — El adaptador de salida solo publica

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 2 · refuerzo. Cita: *"Redis Is Another Thin Adapter Around Our Message Bus."* — Cap. 11.

**Problema:**
1. Para avisar al exterior, publica en el canal. No llames directo a otro servicio.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Salida acoplada a un servicio concreto.
🔴 **Qué hace mal:** Atado a ClienteEnvios y a HTTP; cambiar de transporte obliga a reescribir.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Salida que publica a un canal genérico.
🟢 **Qué mejoró:** Publica a un canal; cualquiera escucha y el transporte se cambia en un sitio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
