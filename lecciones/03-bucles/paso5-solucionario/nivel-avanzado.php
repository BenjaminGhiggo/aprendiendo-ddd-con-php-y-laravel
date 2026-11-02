<?php
// P9: promedio con acumulador.
$notas = [12,15,9,18]; $suma = 0; foreach ($notas as $n) { $suma += $n; }
echo "P9: " . ($suma / count($notas)) . "\n";                               // 13.5
// P10: saltar los ceros con continue y sumar el resto.
$stock = [10,0,4,0,6]; $total = 0; foreach ($stock as $c) { if ($c === 0) continue; $total += $c; }
echo "P10: $total\n";                                                       // 20
// P11: contar palabras repetidas con un array (adelanto de la 05).
$palabras = ["mesa","silla","mesa"]; $conteo = [];
foreach ($palabras as $w) { $conteo[$w] = ($conteo[$w] ?? 0) + 1; }
echo "P11: " . json_encode($conteo) . "\n";                                 // {"mesa":2,"silla":1}
// P12 (puente al libro): el primer lote que puede asignar (sorted + break).
$lotes = [["temprano",100],["tarde",100]]; $pedido = 10; $elegido = "";
foreach ($lotes as $l) { if ($l[1] >= $pedido) { $elegido = $l[0]; break; } }
echo "P12: $elegido\n";                                                      // temprano
