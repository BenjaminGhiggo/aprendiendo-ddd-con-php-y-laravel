<?php
// P9: edad en rango (18..64) con && .
$edad = 40; echo "P9: "; var_export($edad >= 18 && $edad <= 64); echo "\n";   // true
// P10: clasificar edad con elseif en el orden correcto.
$e = 70;
if ($e < 18) { echo "P10: menor\n"; } elseif ($e < 65) { echo "P10: adulto\n"; } else { echo "P10: adulto mayor\n"; }
// P11: ! (negar): si NO hay stock, avisar.
$hayStock = false; if (!$hayStock) { echo "P11: reponer\n"; }
// P12 (puente al libro): can_allocate = sku igual Y cantidad suficiente.
$loteSku = "SOFA"; $lineaSku = "TOSTADORA"; $disp = 100; $qty = 10;
echo "P12: "; var_export($loteSku === $lineaSku && $disp >= $qty); echo "\n";  // false (sku distinto)
