# Ejercicio 3 — Mismo método para todos

> Lección 11 · refuerzo.

**Problema:**
1. Avisar por el canal que sea.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class Email { public function mandar(string $m): string { return "EMAIL: $m"; } }
class Sms { public function textear(string $m): string { return "SMS: $m"; } } // ¡método con otro nombre!
function avisar(object $canal, string $m): string {
    if ($canal instanceof Email) { return $canal->mandar($m); }
    if ($canal instanceof Sms) { return $canal->textear($m); }
    return "";
}
echo avisar(new Email(), "hola") . "\n";
```
🔴 **Qué hace mal:** cada clase tiene su método con otro nombre; la función tiene que adivinar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
interface Notificador { public function enviar(string $m): string; }
class Email implements Notificador { public function enviar(string $m): string { return "EMAIL: $m"; } }
class Sms implements Notificador { public function enviar(string $m): string { return "SMS: $m"; } }
function avisar(Notificador $canal, string $m): string { return $canal->enviar($m); }
echo avisar(new Email(), "hola") . "\n";
```
🟢 **Qué mejoró:** una interfaz obliga a que todos tengan el **mismo** método.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
