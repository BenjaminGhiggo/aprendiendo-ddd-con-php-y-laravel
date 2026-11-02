# Ejercicio 4 (opcional) — Reto: vista de 'pedidos por cliente' ✍️

> Capítulo 12 (CQRS) · micro-paso 2 · refuerzo. Lo resuelves tú.

**Problema:**
1. Mantén con un handler una tabla de lectura cliente -> número de pedidos, y consúltala.
- Versión mala (contar recorriendo todos los pedidos cada vez) en `solucion-mala/main.php`.
- Versión buena (handler que incrementa un contador en la vista) en `solucion-buena/main.php`.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
