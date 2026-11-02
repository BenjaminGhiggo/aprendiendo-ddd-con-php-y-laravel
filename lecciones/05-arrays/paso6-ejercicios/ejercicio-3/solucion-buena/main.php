<?php
// Ej3 — BUENA: $array[] = valor agrega al final sin reescribir el array.
$productos = ["mesa", "silla"];
$productos[] = "lampara";
echo json_encode($productos) . "\n";
