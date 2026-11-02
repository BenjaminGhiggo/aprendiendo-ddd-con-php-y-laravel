<?php

declare(strict_types=1);

// eventos.php — EVENTOS de dominio y mensajes de ENTRADA. Clases simples que describen
// "algo que pasó" (o "algo que se pide"). Son PHP puro (no tocan la base de datos).
//
// ⚠️ En este capítulo TODO es un Evento (incluidas las peticiones de entrada como
// AsignacionRequerida). La separación comando/evento llega en el Capítulo 10.

abstract class Evento {}

// Mensaje de ENTRADA: "quiero asignar esta línea". Entra por el bus.
final class AsignacionRequerida extends Evento
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
    ) {}
}

// Nuevo requisito (micro-paso 2): cambió la cantidad comprada de un lote.
final class CambiarCantidadLote extends Evento
{
    public function __construct(
        public readonly string $referencia,
        public readonly int $cantidad,
    ) {}
}

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
