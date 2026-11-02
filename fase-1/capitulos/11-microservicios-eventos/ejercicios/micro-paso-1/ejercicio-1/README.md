# Ejercicio 1 — Evento externo = datos planos

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 1 · refuerzo. Cita: *"Temporal Decoupling Using Asynchronous Messaging."* — Cap. 11.

**Problema:**
1. Publica 'hacia afuera' que una línea fue asignada. El mensaje externo debe ser datos
   planos (array), no un objeto de tu dominio.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Publicar el objeto de dominio entero al exterior.
🔴 **Qué hace mal:** Mandas un objeto PHP: otro servicio (quizá en otro lenguaje) no puede entenderlo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Publicar un array plano (JSON en producción).
🟢 **Qué mejoró:** Datos planos: cualquier servicio los lee sin conocer tus clases.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
