<?php
echo "P1:\n"; foreach (["a","b","c"] as $x) { echo "$x\n"; }
echo "P2: "; for ($i = 1; $i <= 5; $i++) { echo "$i "; } echo "\n";          // 1 2 3 4 5
$s = 0; foreach ([1,2,3,4] as $n) { $s += $n; } echo "P3: $s\n";             // 10
$c = 0; foreach (range(1,5) as $n) { $c++; } echo "P4: $c\n";                // 5
