<?php
declare(strict_types=1);
// Ej4 RETO — MALA: la asignacion exitosa no deja rastro; nadie mas se entera.
final class Producto {
    public function asignar(string $idPedido, string $sku): ?string {
        return "lote-001"; // asignado, pero sin evento: nadie puede reaccionar al exito
    }
}
echo (new Producto())->asignar("pedido-1", "MESA") . "\n";
