# Ejercicio 2 — El agregado elige el lote en almacén

> Cap. 7 · micro-paso 1 · refuerzo. Cita (regla 6): *"we can move the allocate() domain service to be a method on the Product aggregate."* — Cap. 7.

**Problema:**
1. Entre un lote de envío y uno ya en almacén (sin eta), el agregado debe preferir el de almacén.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$lotes = [['ref' => 'de-envio', 'eta' => '2025-01-02'], ['ref' => 'en-stock', 'eta' => null]];
echo "elige: {$lotes[0]['ref']}\n"; // de-envio (mal: deberia preferir el de almacen)
```
🔴 **Qué hace mal:** toma el primero de la lista sin ordenar; ignora la regla de preferir el almacén.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
$lotes = [['ref' => 'de-envio', 'eta' => '2025-01-02'], ['ref' => 'en-stock', 'eta' => null]];
usort($lotes, function ($a, $b) {
    if ($a['eta'] === null) return -1;
    if ($b['eta'] === null) return 1;
    return $a['eta'] <=> $b['eta'];
});
echo "elige: {$lotes[0]['ref']}\n"; // en-stock
```
🟢 **Qué mejoró:** el agregado ordena (sin eta primero) y elige el lote de almacén.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
