<?php
// Ej2-BUENA: carga el producto CON sus lotes (el agregado completo, como Eloquent with('lotes')).
$producto = ['sku' => 'MESA', 'lotes' => ['l1', 'l2']];
echo "lotes cargados: " . count($producto['lotes']) . "\n"; // 2 (agregado completo)
