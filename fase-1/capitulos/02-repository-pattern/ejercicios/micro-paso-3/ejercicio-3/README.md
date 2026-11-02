# Ejercicio 3 — Probar sin base de datos

> Cap. 2 · micro-paso 3 · refuerzo. Cita (regla 6): *"class SqlAlchemyRepository(AbstractRepository): ..."* — Cap. 2.

**Problema:**
1. ¿Cómo pruebo el servicio sin levantar MySQL?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
el test necesita una base de datos real.
🔴 **Qué hace mal:** tests lentos, frágiles y difíciles de montar en CI.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
el test usa el `RepositorioFalso` en memoria; `assert` comprueba el resultado.
🟢 **Qué mejoró:** test rápido y aislado, sin BD.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
