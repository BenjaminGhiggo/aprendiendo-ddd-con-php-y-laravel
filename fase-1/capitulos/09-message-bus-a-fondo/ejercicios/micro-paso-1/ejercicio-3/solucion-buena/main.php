<?php
declare(strict_types=1);
// Ej3 — BUENA: firma uniforme (evento, uow). El bus llama a todos igual.
final class AsignacionRequerida {
    public function __construct(public readonly string $idPedido, public readonly string $sku, public readonly int $cantidad) {}
}
$uow = new stdClass(); // aqui iria la Unit of Work
function asignar(AsignacionRequerida $e, object $uow): void {
    echo "asignar {$e->idPedido} {$e->sku} {$e->cantidad}\n";
}
asignar(new AsignacionRequerida("o1", "MESA", 10), $uow);
