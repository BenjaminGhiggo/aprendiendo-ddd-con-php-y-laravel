# Ejercicio 2 — La clave es el nombre de la clase

> Cap. 8 · micro-paso 2 · refuerzo. Cita (regla 6): *"for handler in HANDLERS[type(event)]: handler(event)"* — Cap. 8.

**Problema:**
1. En Python la clave del diccionario es la **clase** (`type(event)`). En PHP la clave de un array es texto.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): clave `"SinStock"` escrita a mano como literal.
🔴 **Qué hace mal:** si renombras la clase, el string queda desincronizado y el IDE no avisa.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): clave `SinStock::class` y búsqueda con `$e::class`.
🟢 **Qué mejoró:** `::class` es el nombre real de la clase; renombrar la clase actualiza la clave.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
