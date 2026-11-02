# Ejercicio 4 (opcional) — Reto para ti ✍️

> Lección 16 · refuerzo (ISP). Lo resuelves tú.

**Problema:**
1. Dispositivos: unos solo reproducen audio, otros audio y video.
2. Un reproductor de solo audio no debería tener que implementar video.

**Tu turno:**
- Versión mala en [`solucion-mala/main.php`](solucion-mala/main.php) (una interfaz con audio y video juntos).
- Versión buena en [`solucion-buena/main.php`](solucion-buena/main.php) (interfaces `Audio` y `Video` separadas).

**Para compararlas** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
