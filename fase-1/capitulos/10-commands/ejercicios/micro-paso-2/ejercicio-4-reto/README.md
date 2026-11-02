# Ejercicio 4 (opcional) — Reto: segundo manejador de evento resistente ✍️

> Cap. 10 · micro-paso 2 · refuerzo. Lo resuelves tú.

**Problema:**
1. Un evento `SinStock` tiene dos manejadores: uno que revienta y otro que apunta en un log.
   Comprueba que el log se escribe aunque el primero falle.

**Tu turno:**
- Versión mala (sin aislar: el log no llega) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (aislando cada handler: el log llega) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
