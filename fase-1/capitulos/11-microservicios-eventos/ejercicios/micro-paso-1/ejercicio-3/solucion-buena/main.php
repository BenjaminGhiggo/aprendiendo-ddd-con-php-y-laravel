<?php
// BUENA: dos handlers independientes escuchan el mismo evento. Se componen por separado.
$registro = []; $canal = [];
$handlers = [
  function(array $ev) use (&$registro) { $registro[] = $ev["ref"]; },       // interno
  function(array $ev) use (&$canal)   { $canal[] = ["sku" => $ev["sku"]]; },  // externo
];
$evento = ["ref" => "l1", "sku" => "MESA"];
foreach ($handlers as $h) { $h($evento); }
echo count($registro) . " registro, " . count($canal) . " externo\n";
