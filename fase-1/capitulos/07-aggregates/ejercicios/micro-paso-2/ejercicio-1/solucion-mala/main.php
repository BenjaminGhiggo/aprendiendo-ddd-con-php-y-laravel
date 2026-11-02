<?php
// Ej1-MALA: el repositorio devuelve LOTES sueltos; las reglas del sku quedan repartidas.
$repoLotes = ['l1' => ['sku' => 'MESA'], 'l2' => ['sku' => 'MESA']];
echo "obtiene lote suelto: l1 (sku {$repoLotes['l1']['sku']})\n"; // sin la frontera del agregado
