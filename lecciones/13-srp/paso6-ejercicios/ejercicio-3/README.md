# Ejercicio 3 — Datos y correos no son lo mismo

> Lección 13 · refuerzo (SRP).

**Problema:**
1. Un usuario tiene nombre y email, y se le envía un correo de bienvenida.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Usuario {
    public function __construct(public string $nombre, public string $email) {}
    public function enviarBienvenida(): void { echo "Enviando correo a " . $this->email . "\n"; }
}
(new Usuario("Ana", "ana@x.com"))->enviarBienvenida();
```
🔴 **Qué hace mal:** `Usuario` guarda datos **y** envía correos; cambiar el envío toca la clase que modela al usuario.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Usuario { public function __construct(public string $nombre, public string $email) {} }
final class ServicioCorreo { public function enviarBienvenida(Usuario $u): void { echo "Enviando correo a " . $u->email . "\n"; } }
(new ServicioCorreo())->enviarBienvenida(new Usuario("Ana", "ana@x.com"));
```
🟢 **Qué mejoró:** `Usuario` solo tiene los datos; enviar correos vive en `ServicioCorreo`.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
