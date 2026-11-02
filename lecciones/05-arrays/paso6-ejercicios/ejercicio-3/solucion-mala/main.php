<?php
// Ej3 — MALA (funciona): "agrega" un producto reescribiendo todo el array a mano.
$productos = ["mesa", "silla"];
$productos = ["mesa", "silla", "lampara"]; // reescribe todo para añadir uno
echo json_encode($productos) . "\n";
