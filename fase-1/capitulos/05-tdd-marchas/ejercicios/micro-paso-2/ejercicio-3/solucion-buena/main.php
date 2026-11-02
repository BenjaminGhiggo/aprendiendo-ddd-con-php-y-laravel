<?php
declare(strict_types=1);
// BUENA: comportamiento en marcha ALTA; el test no mira campos internos, solo el resultado observable.
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string {
    return "lote-1";   // da igual como este hecho el dominio por dentro
}
// El test comprueba comportamiento; sobrevive a refactors internos del dominio:
echo servicioAsignar("o1", "LAMPARA", 10) . "\n";
