<?php

declare(strict_types=1);

// eventos.php — EVENTOS de dominio: clases simples que describen "algo que pasó".
// Son PHP puro (no tocan la base de datos).

abstract class Evento {}

final class SinStock extends Evento
{
    public function __construct(public readonly string $sku) {}
}
