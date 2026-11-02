<?php

declare(strict_types=1);

// cola-externa.php — ADAPTADOR EXTERNO: simula Redis pub/sub con un broker EN MEMORIA.
// No hay servidor Redis en este entorno, así que lo simulamos (igual que el repo de Python).
// En producción, publicar() haría Redis::publish() y el consumidor haría Redis::subscribe().
final class ColaExterna
{
    /** @var array<int, array{string, array<string, mixed>}> lo enviado a otros servicios (para los tests) */
    public static array $mensajesPublicados = [];

    public static function publicar(string $canal, array $datos): void
    {
        self::$mensajesPublicados[] = [$canal, $datos];
    }

    public static function limpiar(): void
    {
        self::$mensajesPublicados = [];
    }
}
