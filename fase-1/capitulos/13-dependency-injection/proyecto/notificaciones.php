<?php

declare(strict_types=1);

// notificaciones.php — ejemplo trabajado: convertir una dependencia implícita en un ADAPTADOR
// "de verdad": una interfaz (la abstracción) + implementación real + una falsa para los tests.
interface Notificaciones
{
    public function enviar(string $destino, string $mensaje): void;
}

// Implementación REAL (aquí solo imprime; en producción usaría Mail de Laravel o un SDK).
final class NotificacionesEmail implements Notificaciones
{
    public function enviar(string $destino, string $mensaje): void
    {
        echo "[EMAIL] para {$destino}: {$mensaje}\n";
    }
}

// Implementación FALSA para los tests: guarda lo enviado.
final class NotificacionesFalsas implements Notificaciones
{
    /** @var array<string, string[]> */
    public array $enviadas = [];

    public function enviar(string $destino, string $mensaje): void
    {
        $this->enviadas[$destino][] = $mensaje;
    }
}
