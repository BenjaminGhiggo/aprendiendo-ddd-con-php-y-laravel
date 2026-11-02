# Ejercicio 1 — Inyectar el repositorio (no elegirlo con un `if`)

> Cap. 2 · micro-paso 3 · refuerzo. Cita (regla 6): *"class SqlAlchemyRepository(AbstractRepository): ... def add(self, batch): self.session.add(batch)"* — Cap. 2.

**Problema:**
1. El servicio debe funcionar con el falso (tests) y con el real (producción).

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
un `if ($modo === "test")` decide dentro del servicio; conoce ambos mundos.
🔴 **Qué hace mal:** el servicio depende de los dos; cada nuevo modo lo ensucia más.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
el servicio **recibe** un `RepositorioDeLotes`; no sabe cuál es (puerto/adaptador).
🟢 **Qué mejoró:** cambiar de falso a real no toca el servicio.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
