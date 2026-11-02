<?php
declare(strict_types=1);
// paso4-tu-turno-solucion.php — PASO 4: solución de referencia de paso3.
function restarStock(int $comprado, int $asignado): int
{
    return $comprado - $asignado;
}

function alcanza(int $disponible, int $pedido): bool
{
    return $disponible >= $pedido;
}
