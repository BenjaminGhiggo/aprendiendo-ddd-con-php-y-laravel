# Ejercicio 2 — Ordenar con usort

> Cap. 1 · micro-paso 4 · refuerzo.

**Problema:**
1. Ordenar lotes por su día de llegada.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$lotes = [["ref" => "b", "dia" => 10], ["ref" => "a", "dia" => 2]];
$ordenado = $lotes;
// "ordenar" invirtiendo a mano según el caso... fácil de equivocarse:
if ($ordenado[0]["dia"] > $ordenado[1]["dia"]) { $ordenado = array_reverse($ordenado); }
echo $ordenado[0]["ref"] . "\n"; // a
```
🔴 **Qué hace mal:** ordena a mano con banderas; frágil.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$lotes = [["ref" => "b", "dia" => 10], ["ref" => "a", "dia" => 2], ["ref" => "c", "dia" => 5]];
usort($lotes, fn($x, $y) => $x["dia"] <=> $y["dia"]);
echo $lotes[0]["ref"] . "\n"; // a (el de día más temprano)
```
🟢 **Qué mejoró:** `usort` con un comparador ordena bien, sean los que sean.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
