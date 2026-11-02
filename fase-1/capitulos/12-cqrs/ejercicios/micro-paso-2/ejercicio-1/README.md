# Ejercicio 1 — Tabla de lectura desnormalizada

> Capítulo 12 (CQRS) · micro-paso 2 · refuerzo. Cita: *"Updating a Read Model Table Using an Event Handler."* — Cap. 12.

**Problema:**
1. Para leer rápido, guarda una tabla plana (id_pedido, sku, referencia): solo strings,
   sin relaciones.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Leer recorriendo el agregado (posible N+1).
🔴 **Qué hace mal:** Recorrer el modelo de escritura para leer es lento (bucles anidados, N+1).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): SELECT plano sobre la tabla de lectura.
🟢 **Qué mejoró:** Un filtro directo sobre datos planos: rápido, sin recorrer el agregado.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
