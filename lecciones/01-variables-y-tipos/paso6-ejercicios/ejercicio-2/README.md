# Ejercicio 2 — Interpolar en vez de concatenar

> variables y tipos · Lección 01 · refuerzo.

**Problema:**
1. Muestra un mensaje con el nombre y el número de compras del cliente.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$cliente = "Ada"; $compras = 3;
echo "El cliente " . $cliente . " hizo " . $compras . " compras\n";
```
🔴 **Qué hace mal:** concatena con puntos; el mensaje se lee enredado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$cliente = "Ada"; $compras = 3;
echo "El cliente $cliente hizo $compras compras\n";
```
🟢 **Qué mejoró:** la interpolación deja el mensaje legible.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
