# Ejercicio 2 — El evento mantiene la vista

> Capítulo 12 (CQRS) · micro-paso 2 · refuerzo. Cita: *"Updating a Read Model Table Using an Event Handler."* — Cap. 12.

**Problema:**
1. Cuando ocurre 'Asignado', un handler inserta una fila en la tabla de lectura.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Rellenar la vista a mano desde el controlador.
🔴 **Qué hace mal:** Actualizar la vista a mano en cada endpoint: fácil de olvidar, queda desincronizada.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Handler de evento que inserta en la vista.
🟢 **Qué mejoró:** El evento mantiene la vista: pase donde pase la asignación, la vista se actualiza.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
