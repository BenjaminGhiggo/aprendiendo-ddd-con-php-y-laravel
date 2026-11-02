<?php

declare(strict_types=1);

require_once __DIR__ . '/eventos.php';

// mensajeria.php — el BUS DE MENSAJES: mapea cada TIPO de evento a sus manejadores.
// En Python: HANDLERS = { eventos.SinStock: [handler] } y HANDLERS[type(evento)].
// En PHP la clave de un array debe ser string/int, así que se usa Evento::class (el nombre
// de la clase como texto; Lección 05) y se busca con $evento::class (o get_class($evento)).

// Registro para que los tests comprueben qué notificaciones se enviaron.
final class RegistroNotificaciones
{
    /** @var string[] */
    public static array $enviadas = [];
}

function enviarNotificacionSinStock(Evento $evento): void
{
    assert($evento instanceof SinStock);
    RegistroNotificaciones::$enviadas[] = $evento->sku;
}

/** @return array<class-string, callable[]> */
function manejadores(): array
{
    return [
        SinStock::class => ['enviarNotificacionSinStock'],
    ];
}

function manejar(Evento $evento): void
{
    $manejadores = manejadores()[$evento::class] ?? [];
    foreach ($manejadores as $manejador) {
        $manejador($evento);
    }
}
