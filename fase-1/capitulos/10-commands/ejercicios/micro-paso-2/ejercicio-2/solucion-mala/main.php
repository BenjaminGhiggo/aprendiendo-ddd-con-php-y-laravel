<?php
declare(strict_types=1);
// Ej2 — MALA: el bus se traga el error del comando; el emisor nunca se entera.
function manejarComando(callable $h): void {
    try { $h(); } catch (\Throwable $e) { /* silencio */ }
}
manejarComando(function () { throw new \RuntimeException("sku invalido"); });
echo "el emisor cree que todo fue bien (mal)\n";
