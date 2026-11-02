# Ejercicio 1 — Una función: o escribe o lee

> Capítulo 12 (CQRS) · micro-paso 1 · refuerzo. Cita: *"functions should either modify state or answer questions, but never both."* — Cap. 12.

**Problema:**
1. Tienes una función que asigna (escribe) y además devuelve datos para mostrar (lee).
   Sepárala en dos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php): Función que modifica y además devuelve datos.
🔴 **Qué hace mal:** Mezcla escribir con leer: recargar la página reenvía el POST y asigna otra vez.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): Un comando que escribe; una consulta que lee.
🟢 **Qué mejoró:** Escribir y leer separados: el POST ya no devuelve datos, se evita el doble submit.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
