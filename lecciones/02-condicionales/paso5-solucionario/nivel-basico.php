<?php
$x = 7; echo "P1: "; var_export($x > 5); echo "\n";            // true
$y = 4; if ($y % 2 === 0) { echo "P2: par\n"; } else { echo "P2: impar\n"; }
$edad = 16; echo "P3: " . ($edad >= 18 ? "mayor" : "menor") . "\n"; // menor
echo "P4: "; var_export(5 === "5"); echo "\n";                 // false (distinto tipo)
