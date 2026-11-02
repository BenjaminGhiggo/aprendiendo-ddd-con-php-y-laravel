<?php
declare(strict_types=1);
// Ej3 — MALA: cada servicio tiene argumentos sueltos distintos; el bus no puede ser generico.
function asignar(string $idPedido, string $sku, int $cantidad): void {
    echo "asignar $idPedido $sku $cantidad\n";
}
asignar("o1", "MESA", 10); // el bus tendria que conocer estos 3 parametros
