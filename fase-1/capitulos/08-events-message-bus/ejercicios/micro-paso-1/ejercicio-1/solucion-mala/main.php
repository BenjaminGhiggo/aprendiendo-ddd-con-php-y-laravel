<?php
declare(strict_types=1);
// Ej1 — MALA: el "evento" es un string suelto; hay que parsearlo a mano en todos lados.
$evento = "SinStock:MESA";
[$tipo, $sku] = explode(":", $evento); // frágil: y si el sku lleva ":"?
echo "$tipo del sku $sku\n";
