# Ejercicio 2 — Buscar un precio

> Lección 05 · refuerzo.

**Problema:**
1. Busca y muestra el precio de "lampara".

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$productos = ["mesa", "silla", "lampara"];
$precios = [100, 50, 30];
$buscado = "lampara";
$i = 0;
while ($i < 3) {
    if ($productos[$i] === $buscado) { echo $precios[$i] . "\n"; }
    $i = $i + 1;
}
```
🔴 **Qué hace mal:** recorre todo con un `while` y un índice para encontrar una cosa.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$precios = ["mesa" => 100, "silla" => 50, "lampara" => 30];
echo $precios["lampara"] . "\n";
```
🟢 **Qué mejoró:** el array asociativo va directo a la clave.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
