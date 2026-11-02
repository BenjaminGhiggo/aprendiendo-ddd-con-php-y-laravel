# Ejercicio 1 — Depende de la interfaz, no de la clase

> Capítulo 13 (Dependency Injection) · micro-paso 2 · refuerzo. Cita: *"1. Define your API using an ABC. 2. Implement the real thing. 3. Build a fake and use it for ... tests."* — Cap. 13.

**Problema:**
1. El código que notifica debe depender de la interfaz Notificaciones, no de Email.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Tipo concreto en la firma.
🔴 **Qué hace mal:** Firma atada a Email: cambiar de canal o testear sin enviar es imposible.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Interfaz en la firma.
🟢 **Qué mejoró:** Pide la abstracción: cualquier implementación (Email, SMS, falsa) encaja.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
