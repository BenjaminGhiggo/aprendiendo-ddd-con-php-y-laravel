<?php
// Ej1-MALA: se asigna a un lote suelto; nadie sube el "numero de version" del producto.
$lote = ['referencia' => 'l1', 'disponible' => 100];
$lote['disponible'] -= 10;         // asignamos directo al lote
$version = 0;                       // ...y la version del producto se queda en 0
echo "disponible={$lote['disponible']} version=$version\n"; // version=0 (no detecta el cambio)
