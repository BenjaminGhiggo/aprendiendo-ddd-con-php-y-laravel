# Ejercicio 3 — El error de un evento se AÍSLA

> Cap. 10 · micro-paso 2 · refuerzo. Cita (regla 6): *"It catches and logs errors but doesn't let them interrupt message processing."* — Cap. 10.

**Problema:**
1. Un evento tiene varios manejadores; si uno revienta, los demás deben seguir.

**Solución mala (funciona a medias)** — [`solucion-mala/main.php`](solucion-mala/main.php): recorre los handlers sin `try/catch`.
🔴 **Qué hace mal:** el primero que falla corta el `foreach`; los demás no corren.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php): cada handler va en su `try/catch` con `continue`.
🟢 **Qué mejoró:** un fallo se aísla; el resto de reacciones siguen.

```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
