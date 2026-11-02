# Ejercicio 2 — Excepción vs código de error

> Lección 07 · refuerzo.

**Problema:**
1. Busca el precio de un sku; si no existe, avisa.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function buscarPrecio(array $precios, string $sku): int {
    return $precios[$sku] ?? -1;  // -1 significa "no encontrado"... si no lo olvidas
}
$p = buscarPrecio(["mesa" => 100], "silla");
echo $p . "\n"; // -1 (¿un precio de -1?)
```
🔴 **Qué hace mal:** usa un código numérico (-1) que hay que recordar comprobar.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class ProductoNoExiste extends \Exception {}
function buscarPrecio(array $precios, string $sku): int {
    if (!array_key_exists($sku, $precios)) { throw new ProductoNoExiste($sku); }
    return $precios[$sku];
}
try { echo buscarPrecio(["mesa" => 100], "silla") . "\n"; }
catch (ProductoNoExiste $e) { echo "no existe: " . $e->getMessage() . "\n"; }
```
🟢 **Qué mejoró:** lanza una excepción clara; el que llama debe manejarla.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
