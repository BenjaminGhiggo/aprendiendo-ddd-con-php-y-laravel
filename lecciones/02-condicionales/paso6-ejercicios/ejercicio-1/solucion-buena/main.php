<?php
// Ej1 — BUENA: if/elseif/else se detiene en cuanto uno acierta y no repite comparaciones.
$edad = 30;
if ($edad < 18) { $resultado = "menor"; }
elseif ($edad < 65) { $resultado = "adulto"; }
else { $resultado = "adulto mayor"; }
echo "$resultado\n";
