# Ejercicio 4 (opcional) — Reto: publica EventoSinStock al exterior ✍️

> Capítulo 11 (Microservicios / Event-Driven) · micro-paso 1 · refuerzo. Lo resuelves tú.

**Problema:**
1. Cuando no hay stock, además de registrarlo, publica un evento externo 'sin_stock'
   con el sku (array plano).
- Versión mala (llamar directo a un 'ServicioAlertas') en `solucion-mala/main.php`.
- Versión buena (publicar un array al canal) en `solucion-buena/main.php`.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
```
