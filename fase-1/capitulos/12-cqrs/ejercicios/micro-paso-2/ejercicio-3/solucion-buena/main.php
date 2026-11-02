<?php
// BUENA: el dominio emite el evento; QUIÉN lo guarda (array hoy, Redis mañana) es un handler.
$almacen = [];
$handler = function(string $ref) use (&$almacen) { $almacen[] = $ref; }; // cambiable sin tocar el dominio
function asignarDominio(string $ref, callable $handler): void { $handler($ref); }
asignarDominio("l1", $handler);
echo count($almacen) . "\n";
