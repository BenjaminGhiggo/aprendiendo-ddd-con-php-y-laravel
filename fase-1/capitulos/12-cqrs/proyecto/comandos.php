<?php

declare(strict_types=1);

// comandos.php — COMANDOS: órdenes imperativas ("haz esto"). Un solo handler; si falla, el
// error PROPAGA (quien dio la orden debe enterarse).

abstract class Comando {}

final class Asignar extends Comando
{
    public function __construct(
        public string $idPedido,
        public string $sku,
        public int $cantidad,
    ) {}
}

final class CrearLote extends Comando
{
    public function __construct(
        public string $referencia,
        public string $sku,
        public int $cantidad,
        public ?\DateTimeImmutable $eta = null,
    ) {}
}

final class CambiarCantidadLote extends Comando
{
    public function __construct(
        public string $referencia,
        public int $cantidad,
    ) {}
}
