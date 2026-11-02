<?php
// Ej1 — MALA: tres if separados; PHP evalúa todos aunque uno ya acertó.
$edad = 30; $resultado = "";
if ($edad < 18) { $resultado = "menor"; }
if ($edad >= 18 && $edad < 65) { $resultado = "adulto"; }
if ($edad >= 65) { $resultado = "adulto mayor"; }
echo "$resultado\n";
