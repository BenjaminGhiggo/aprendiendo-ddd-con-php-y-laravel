# Ejercicio 2 — Dos adaptadores intercambiables

> Cap. 2 · micro-paso 3 · refuerzo. Cita (regla 6): *"class SqlAlchemyRepository(AbstractRepository): ..."* — Cap. 2.

**Problema:**
1. Un repositorio en memoria y uno de BD deben poder cambiarse sin tocar al que los usa.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
uno tiene `buscar()` y el otro `obtener()`; no son intercambiables.
🔴 **Qué hace mal:** cambiar de uno a otro obliga a renombrar llamadas por todo el código.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
los dos `implements RepositorioDeLotes` con `obtener()`; el que llama no cambia.
🟢 **Qué mejoró:** mismo enchufe (la interfaz), dos adaptadores.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
