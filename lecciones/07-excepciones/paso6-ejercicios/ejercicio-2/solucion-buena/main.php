<?php
declare(strict_types=1);
// Ej2 — BUENA: lanza una excepción clara cuando no existe; el que llama DEBE manejarla.
class ProductoNoExiste extends \Exception {}
function buscarPrecio(array $precios, string $sku): int {
    if (!array_key_exists($sku, $precios)) { throw new ProductoNoExiste($sku); }
    return $precios[$sku];
}
try { echo buscarPrecio(["mesa" => 100], "silla") . "\n"; }
catch (ProductoNoExiste $e) { echo "no existe: " . $e->getMessage() . "\n"; }
