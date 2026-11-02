<?php
// Ej2 — MALA (funciona): busca un precio recorriendo arrays paralelos con un índice.
$productos = ["mesa", "silla", "lampara"];
$precios = [100, 50, 30];
$buscado = "lampara";
$i = 0;
while ($i < 3) {
    if ($productos[$i] === $buscado) { echo $precios[$i] . "\n"; }
    $i = $i + 1;
}
