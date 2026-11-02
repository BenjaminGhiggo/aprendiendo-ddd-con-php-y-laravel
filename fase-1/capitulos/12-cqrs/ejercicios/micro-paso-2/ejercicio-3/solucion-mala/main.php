<?php
// MALA: el dominio conoce el motor (array global); cambiarlo a Redis obliga a tocar el dominio.
$GLOBALS["vista"] = [];
function asignarDominio(string $ref): void { $GLOBALS["vista"][] = $ref; } // acoplado al array
asignarDominio("l1");
echo count($GLOBALS["vista"]) . "\n";
