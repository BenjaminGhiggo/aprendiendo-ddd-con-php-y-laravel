# Ejercicio 1 — Un dato, una variable

> variables y tipos · Lección 01 · refuerzo. Cita (regla 6): *"We have an initial conversation with our business experts and agree on a glossary ..."* — Cap. 1.

**Problema:**
1. Saluda y despide a una persona cuyo nombre puede cambiar.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo "Hola, Ada\n";
echo "Adiós, Ada\n";
```
🔴 **Qué hace mal:** repite el nombre a mano en cada línea; si cambia, hay que editar todo.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$nombre = "Ada";
echo "Hola, $nombre\n";
echo "Adiós, $nombre\n";
```
🟢 **Qué mejoró:** el nombre vive en una variable; cambiarlo una vez cambia todo.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
