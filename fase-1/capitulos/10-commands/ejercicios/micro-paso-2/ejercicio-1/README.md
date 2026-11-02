# Ejercicio 1 — Un comando, un manejador

> Cap. 10 · micro-paso 2 · refuerzo. Cita (regla 6): *"The command dispatcher expects just one handler per command."* — Cap. 10.

**Problema:**
1. ¿Cuántos manejadores atiende un comando?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): guarda una **lista** de handlers por comando.
🔴 **Qué hace mal:** invita a varios responsables para una orden; se pierde la convención.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): el mapa de comandos guarda **un** callable por comando.
🟢 **Qué mejoró:** un único responsable por orden, como manda la convención.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
