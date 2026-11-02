<?php

declare(strict_types=1);

use Illuminate\Container\Container;

require_once __DIR__ . '/mensajeria.php';

// bootstrap.php — el COMPOSITION ROOT: el único lugar donde se inyectan dependencias.
// El Python lo hace a mano. En PHP/Laravel lo hace el CONTENEDOR DE SERVICIOS
// (illuminate/container, el mismo que usa Laravel): se "liga" una interfaz a una implementación
// y el contenedor la resuelve e inyecta por el constructor automáticamente.
final class Bootstrap
{
    public static function arrancar(?Notificaciones $notificaciones = null): Container
    {
        $contenedor = new Container();

        // Liga la ABSTRACCIÓN a una implementación. En producción: NotificacionesEmail;
        // en tests: NotificacionesFalsas (se pasa por parámetro para sobreescribir el default).
        $contenedor->instance(
            Notificaciones::class,
            $notificaciones ?? new NotificacionesEmail(),
        );

        // El bus toma del contenedor la dependencia que necesita (inyección manual aquí para el bus
        // estático; en un servicio normal el contenedor la inyectaría por el constructor).
        Bus::$notificaciones = $contenedor->make(Notificaciones::class);

        return $contenedor;
    }
}
