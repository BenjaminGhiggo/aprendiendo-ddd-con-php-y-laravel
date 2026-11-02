# Ejercicio 2 — Recorrer sin ifs

> Lección 11 · refuerzo.

**Problema:**
1. Enviar un mensaje por varios canales.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$items = [["tipo" => "email", "msg" => "hola"], ["tipo" => "sms", "msg" => "hola"]];
foreach ($items as $i) {
    if ($i["tipo"] === "email") { echo "EMAIL: {$i['msg']}\n"; }
    elseif ($i["tipo"] === "sms") { echo "SMS: {$i['msg']}\n"; }
}
```
🔴 **Qué hace mal:** mete un `if` por tipo dentro del bucle.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
interface Notificador { public function enviar(string $m): string; }
class Email implements Notificador { public function enviar(string $m): string { return "EMAIL: $m"; } }
class Sms implements Notificador { public function enviar(string $m): string { return "SMS: $m"; } }
foreach ([new Email(), new Sms()] as $n) { echo $n->enviar("hola") . "\n"; }
```
🟢 **Qué mejoró:** cada clase implementa el mismo método; el bucle lo llama sin ifs.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
