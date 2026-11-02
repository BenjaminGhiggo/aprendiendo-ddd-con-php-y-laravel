<?php

declare(strict_types=1);

// eventos.php — EVENTOS: hechos ("esto pasó"). Los nombramos en pasado (Asignado, Desasignado).
// Un evento puede tener VARIOS manejadores y, si uno falla, el error se AÍSLA (no rompe el flujo).

abstract class Evento {}

// Algo pasó: se asignó una línea a un lote.
final class Asignado extends Evento
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
        public readonly string $referencia,
    ) {}
}

// Algo pasó: no había stock para un sku.
final class SinStock extends Evento
{
    public function __construct(public readonly string $sku) {}
}

// Algo pasó: una línea quedó desasignada (hay que reasignarla).
final class Desasignado extends Evento
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
    ) {}
}
