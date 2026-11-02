<?php

declare(strict_types=1);

// eventos.php — EVENTOS: hechos ("esto pasó"). Varios handlers; si uno falla, se AÍSLA.
// (Lección 05: usaremos el nombre de la CLASE del evento como clave de un array en el bus.)

abstract class Evento {}

final class Asignado extends Evento
{
    public function __construct(
        public string $idPedido,
        public string $sku,
        public int $cantidad,
        public string $referencia,
    ) {}
}

final class EventoSinStock extends Evento
{
    public function __construct(public string $sku) {}
}

final class Desasignado extends Evento
{
    public function __construct(
        public string $idPedido,
        public string $sku,
        public int $cantidad,
    ) {}
}
