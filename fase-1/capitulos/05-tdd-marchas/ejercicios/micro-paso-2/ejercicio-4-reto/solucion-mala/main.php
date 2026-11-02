<?php
declare(strict_types=1);
// MALA: una sola marcha para todo. Aqui: todo en marcha alta -> cuesta localizar un fallo fino.
function servicioAsignar(string $sku): string {
    // una regla nueva y dudosa metida aqui dentro; si falla, el test de servicio no la aisla
    return "lote-1";
}
echo servicioAsignar("LAMPARA") . "\n";
