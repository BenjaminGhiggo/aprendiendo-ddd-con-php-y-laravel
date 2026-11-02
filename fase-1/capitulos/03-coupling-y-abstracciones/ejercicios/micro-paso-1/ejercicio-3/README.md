# Ejercicio 3 — Devolver acciones, no ejecutarlas

> Cap. 3 · micro-paso 1 · refuerzo. Cita (regla 6): *"our domain logic ... is tightly coupled to the I/O code."* — Cap. 3.

**Problema:**
1. La lógica imprime/ejecuta el efecto en el momento; no se puede inspeccionar qué decidió.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
`echo "copiando..."` dentro de la decisión; para comprobarla hay que leer la salida de texto.
🔴 **Qué hace mal:** el efecto inmediato impide verificar la decisión limpiamente.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
`decidir()` **devuelve** `[['COPIAR','b']]`; `assert` comprueba el resultado.
🟢 **Qué mejoró:** se verifica el valor devuelto, no el efecto.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
