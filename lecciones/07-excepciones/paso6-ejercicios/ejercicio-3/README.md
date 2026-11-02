# Ejercicio 3 — Atrapar solo lo que manejas

> Lección 07 · refuerzo.

**Problema:**
1. Procesa una entrada; si es inválida, repórtalo.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function procesar(string $dato): string {
    try {
        if ($dato === "") { throw new \InvalidArgumentException("vacío"); }
        return "ok: $dato";
    } catch (\Throwable $e) {
        return "ok"; // se traga el error: nadie se entera de que falló
    }
}
echo procesar("") . "\n"; // "ok" (¡pero falló!)
```
🔴 **Qué hace mal:** atrapa TODO con `catch (\Throwable)` y esconde el error.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function procesar(string $dato): string {
    if ($dato === "") { throw new \InvalidArgumentException("vacío"); }
    return "ok: $dato";
}
try { echo procesar("") . "\n"; }
catch (\InvalidArgumentException $e) { echo "entrada inválida: " . $e->getMessage() . "\n"; }
```
🟢 **Qué mejoró:** atrapa solo lo que sabe manejar y deja que el resto suba.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
