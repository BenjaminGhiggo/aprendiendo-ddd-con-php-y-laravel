# Ejercicio 1 — El adaptador de entrada solo traduce

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 2 · refuerzo. Cita: *"Redis Is Another Thin Adapter Around Our Message Bus."* — Cap. 11.

**Problema:**
1. Llega un mensaje externo (array). El adaptador de entrada debe SOLO traducirlo a un
   comando y delegar; nada de reglas de negocio.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Adaptador con lógica de negocio dentro.
🔴 **Qué hace mal:** El adaptador decide reglas; si cambian, tocas el transporte. Difícil de testear.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Adaptador fino: traduce a comando y delega.
🟢 **Qué mejoró:** El adaptador es fino (solo traduce); las reglas quedan en un solo sitio reusable.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
