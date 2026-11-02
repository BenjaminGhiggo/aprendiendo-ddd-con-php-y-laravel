<?php

declare(strict_types=1);

// comandos.php — COMANDOS: órdenes imperativas ("haz esto"). Los nombramos con verbos en
// imperativo (Asignar, CrearLote). Un comando tiene UN SOLO manejador y, si falla, el error
// PROPAGA (quien dio la orden debe enterarse).

abstract class Comando {}

final class Asignar extends Comando
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
    ) {}
}

final class CrearLote extends Comando
{
    public function __construct(
        public readonly string $referencia,
        public readonly string $sku,
        public readonly int $cantidad,
        public readonly ?string $eta = null,
    ) {}
}

final class CambiarCantidadLote extends Comando
{
    public function __construct(
        public readonly string $referencia,
        public readonly int $cantidad,
    ) {}
}
