<?php
// Ej2-MALA: el agregado toma el PRIMER lote de la lista sin ordenar (ignora el de almacen).
$lotes = [['ref' => 'de-envio', 'eta' => '2025-01-02'], ['ref' => 'en-stock', 'eta' => null]];
echo "elige: {$lotes[0]['ref']}\n"; // de-envio (mal: deberia preferir el de almacen)
