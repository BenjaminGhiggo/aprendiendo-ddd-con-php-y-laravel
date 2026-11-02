<?php
declare(strict_types=1);
// Ej2 — MALA: copiar y pegar la misma función en cada archivo que la necesita.
function iva(float $precio): float { return $precio * 1.18; } // copiada aquí...
echo iva(100) . "\n";
// ...y copiada igual en otros 5 archivos. Si cambia el IVA, hay que editar los 6.
