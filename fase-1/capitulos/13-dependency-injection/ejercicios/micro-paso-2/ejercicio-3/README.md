# Ejercicio 3 — La falsa guarda lo enviado

> Capítulo 13 (Dependency Injection) · micro-paso 2 · refuerzo. Cita: *"1. Define your API using an ABC. 2. Implement the real thing. 3. Build a fake and use it for ... tests."* — Cap. 13.

**Problema:**
1. Para testear sin enviar, crea una falsa que guarde los mensajes en un array.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Testear enviando de verdad.
🔴 **Qué hace mal:** Enviar de verdad en el test: efectos reales y nada que inspeccionar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Falsa inspeccionable para el assert.
🟢 **Qué mejoró:** La falsa guarda los mensajes: el test comprueba sin enviar nada real.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
