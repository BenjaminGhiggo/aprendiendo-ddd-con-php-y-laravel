# Ejercicio 3 — Un handler uniforme `(mensaje, uow)`

> Cap. 9 · micro-paso 1 · refuerzo. Cita (regla 6): *"Refactoring Service Functions to Message Handlers"* — Cap. 9.

**Problema:**
1. El bus debe llamar a cualquier handler igual, sin conocer sus argumentos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): cada servicio recibe argumentos sueltos distintos.
🔴 **Qué hace mal:** el bus tendría que saber qué argumentos pasa a cada uno; no es uniforme.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): todos los handlers tienen la firma `(evento, uow)`.
🟢 **Qué mejoró:** el bus los invoca a todos igual; los datos viajan dentro del evento.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
