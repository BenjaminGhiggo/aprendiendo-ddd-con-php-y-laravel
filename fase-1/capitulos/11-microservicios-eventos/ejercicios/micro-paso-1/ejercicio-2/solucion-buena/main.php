<?php
// BUENA: publicamos un evento al canal; quien quiera (Envios) lo consume cuando pueda.
$canal = [];
function asignar(string $sku, array &$canal): void { /* ...reglas... */ $canal[] = ["evento" => "linea_asignada", "sku" => $sku]; }
asignar("MESA", $canal);
echo $canal[0]["evento"] . ": " . $canal[0]["sku"] . "\n";
