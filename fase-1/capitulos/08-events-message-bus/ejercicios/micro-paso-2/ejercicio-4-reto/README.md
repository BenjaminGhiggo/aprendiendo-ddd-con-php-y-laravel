# Ejercicio 4 (opcional) — Reto: segundo manejador ✍️

> Cap. 8 · micro-paso 2 · refuerzo. Lo resuelves tú.

**Problema:**
1. Partiendo del bus del capítulo, registra un **segundo** manejador para `SinStock` (por ejemplo, que lo apunte en un log) y comprueba que el bus llama a los dos.

**Tu turno:**
- Versión mala (un solo manejador, la segunda reacción metida a la fuerza dentro del primero) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (dos manejadores en la lista del mapa) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
