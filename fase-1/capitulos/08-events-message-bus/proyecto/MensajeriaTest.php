<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/mensajeria.php';

// El bus es PHP puro: no toca la base de datos.
final class MensajeriaTest extends TestCase
{
    protected function setUp(): void
    {
        RegistroNotificaciones::$enviadas = [];
    }

    public function test_el_bus_lleva_el_evento_sin_stock_a_su_manejador(): void
    {
        manejar(new SinStock('MESA'));
        $this->assertSame(['MESA'], RegistroNotificaciones::$enviadas);
    }

    public function test_un_evento_sin_manejadores_no_hace_nada(): void
    {
        $otro = new class ('X') extends Evento {
            public function __construct(public readonly string $sku) {}
        };
        manejar($otro);
        $this->assertSame([], RegistroNotificaciones::$enviadas);
    }
}
