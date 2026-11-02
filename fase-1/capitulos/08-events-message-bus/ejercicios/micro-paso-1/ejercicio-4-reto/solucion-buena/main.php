<?php
declare(strict_types=1);
// Ej4 RETO — BUENA: tambien el exito es un evento de dominio.
abstract class Evento {}
final class Asignado extends Evento {
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly string $referencia,
    ) {}
}
final class Producto {
    /** @var Evento[] */
    public array $eventos = [];
    public function asignar(string $idPedido, string $sku): ?string {
        $ref = "lote-001";
        $this->eventos[] = new Asignado($idPedido, $sku, $ref);
        return $ref;
    }
}
$p = new Producto();
$p->asignar("pedido-1", "MESA");
$e = $p->eventos[0];
echo "Asignado: {$e->idPedido} {$e->sku} -> {$e->referencia}\n";
