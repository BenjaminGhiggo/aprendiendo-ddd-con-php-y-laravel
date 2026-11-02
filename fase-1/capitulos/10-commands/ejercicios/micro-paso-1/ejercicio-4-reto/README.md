# Ejercicio 4 (opcional) — Reto: comando `Desasignar` ✍️

> Cap. 10 · micro-paso 1 · refuerzo. Lo resuelves tú.

**Problema:**
1. Añade un comando `Desasignar(idPedido, sku)` y comprueba que es `Comando` y NO `Evento`.

**Tu turno:**
- Versión mala (`Desasignar` sin heredar de nada, se confunde con los eventos) en [`solucion-mala/main.php`](solucion-mala/main.php).
- Versión buena (`Desasignar extends Comando`) en [`solucion-buena/main.php`](solucion-buena/main.php).

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
