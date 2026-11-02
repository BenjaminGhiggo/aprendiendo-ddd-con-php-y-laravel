<?php
// Ej2-MALA: carga el producto SIN sus lotes; al asignar, el agregado esta incompleto.
$producto = ['sku' => 'MESA']; // sin 'lotes'
echo "lotes cargados: " . count($producto['lotes'] ?? []) . "\n"; // 0 (incompleto)
