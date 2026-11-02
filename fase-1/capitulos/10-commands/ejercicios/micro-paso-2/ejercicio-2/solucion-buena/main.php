<?php
declare(strict_types=1);
// Ej2 — BUENA: el comando no se envuelve; el error propaga y el emisor lo captura.
function manejarComando(callable $h): void {
    $h(); // sin try/catch: si falla, sube
}
try {
    manejarComando(function () { throw new \RuntimeException("sku invalido"); });
} catch (\Throwable $e) {
    echo "el emisor se entera: {$e->getMessage()}\n";
}
