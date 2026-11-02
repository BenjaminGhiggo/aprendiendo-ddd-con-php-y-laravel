<?php
declare(strict_types=1);
// MALA: el "test" depende de una conexion (aqui simulada): lento y fragil.
function servicioAsignar(callable $traerDeLaBD): string {
    $lotes = $traerDeLaBD();      // golpea la BD cada vez
    return $lotes[0];
}
// "test": necesita una BD de verdad para correr
$conexion = fn() => (function () { /* ... abrir socket, SELECT ... */ return ["lote-1"]; })();
echo servicioAsignar($conexion) . "\n";
