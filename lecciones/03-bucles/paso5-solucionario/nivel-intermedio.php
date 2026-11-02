<?php
$p = 1; foreach ([2,3,4] as $n) { $p *= $n; } echo "P5: $p\n";               // 24
$pares = 0; foreach (range(1,10) as $n) { if ($n % 2 === 0) $pares++; } echo "P6: $pares\n"; // 5
echo "P7: "; $i = 0; while ($i < 4) { echo "$i "; $i++; } echo "\n";         // 0 1 2 3
echo "P8: "; foreach (range(1,10) as $n) { if ($n > 5) { echo $n; break; } } echo "\n"; // 6
