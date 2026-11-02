# Ejercicio 1 — `ejecutar(callable)` con `try`/`finally`

> Cap. 6 · micro-paso 2 · refuerzo. Cita (regla 6): *"with uow:"* — Cap. 6. En PHP no hay `with`: se traduce a un método `ejecutar(callable)` con `try`/`finally`.

**Problema:**
1. Traduce el `with uow:` de Python a un `ejecutar(callable)` que **siempre** deshaga lo no confirmado.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo "beginTransaction\n";
echo "guardar\n";
// si aquí hubiera una excepción, nunca llegaríamos al commit NI al rollback -> transacción colgada
echo "commit\n";
```
🔴 **Qué hace mal:** sin `finally`, una excepción deja la transacción abierta y colgada.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function ejecutar(callable $trabajo): void {
    echo "beginTransaction\n";
    try { $trabajo(); }
    finally { echo "rollback de lo no confirmado\n"; }
}
ejecutar(function () { echo "guardar\n"; echo "commit\n"; });
```
🟢 **Qué mejoró:** el `finally` hace el papel del `__exit__` de Python: pase lo que pase, deshace lo no confirmado.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
