<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/comandos.php';
require_once __DIR__ . '/eventos.php';

// Prueba PURA (sin BD): comandos y eventos son jerarquías distintas. El bus las separa por esto.
final class ComandosTest extends TestCase
{
    public function test_un_comando_es_Comando_y_no_Evento(): void
    {
        $asignar = new Asignar('o1', 'MESA', 10);
        $this->assertInstanceOf(Comando::class, $asignar);
        $this->assertNotInstanceOf(Evento::class, $asignar);
    }

    public function test_un_evento_es_Evento_y_no_Comando(): void
    {
        $asignado = new Asignado('o1', 'MESA', 10, 'l1');
        $this->assertInstanceOf(Evento::class, $asignado);
        $this->assertNotInstanceOf(Comando::class, $asignado);
    }
}
