<?php
// Ej2-BUENA: el agregado ORDENA (lote sin eta primero) y elige el de almacen.
$lotes = [['ref' => 'de-envio', 'eta' => '2025-01-02'], ['ref' => 'en-stock', 'eta' => null]];
usort($lotes, function ($a, $b) {
    if ($a['eta'] === null) return -1;
    if ($b['eta'] === null) return 1;
    return $a['eta'] <=> $b['eta'];
});
echo "elige: {$lotes[0]['ref']}\n"; // en-stock
