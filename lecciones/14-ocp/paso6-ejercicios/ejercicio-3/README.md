# Ejercicio 3 — Avisar por varios canales

> Lección 14 · refuerzo.

**Problema:**
1. Enviar un aviso por el canal que toque.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function avisar(string $canal, string $msg): void {
    if ($canal === "email") { echo "EMAIL: $msg\n"; }
    elseif ($canal === "sms") { echo "SMS: $msg\n"; }
}
avisar("email", "hola");
```
🔴 **Qué hace mal:** para añadir un canal hay que editar la función (if por canal).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function avisar(callable $canal, string $msg): void { $canal($msg); }
avisar(fn(string $m) => print("EMAIL: $m\n"), "hola");
avisar(fn(string $m) => print("SMS: $m\n"), "hola");
```
🟢 **Qué mejoró:** la función recibe CÓMO avisar; un canal nuevo no la toca (OCP).

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
