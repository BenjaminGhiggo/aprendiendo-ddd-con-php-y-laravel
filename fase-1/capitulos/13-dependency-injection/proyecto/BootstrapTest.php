<?php

declare(strict_types=1);

use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/bootstrap.php';

// Pruebas del COMPOSITION ROOT: que el contenedor de Laravel resuelve la abstracción a la
// implementación ligada, y que el bus queda con esa dependencia inyectada.
final class BootstrapTest extends TestCase
{
    protected function tearDown(): void
    {
        Bus::$notificaciones = null;
    }

    public function test_arrancar_devuelve_un_contenedor(): void
    {
        $contenedor = Bootstrap::arrancar();
        $this->assertInstanceOf(Container::class, $contenedor);
    }

    public function test_el_contenedor_resuelve_la_abstraccion_a_la_implementacion_ligada(): void
    {
        $falsas = new NotificacionesFalsas();
        $contenedor = Bootstrap::arrancar($falsas);
        // Pido la INTERFAZ y el contenedor me da la implementación concreta que ligué.
        $this->assertSame($falsas, $contenedor->make(Notificaciones::class));
    }

    public function test_por_defecto_liga_la_implementacion_de_email(): void
    {
        $contenedor = Bootstrap::arrancar();
        $this->assertInstanceOf(NotificacionesEmail::class, $contenedor->make(Notificaciones::class));
    }

    public function test_el_bus_queda_con_la_dependencia_inyectada(): void
    {
        $falsas = new NotificacionesFalsas();
        Bootstrap::arrancar($falsas);
        $this->assertSame($falsas, Bus::$notificaciones);
    }
}
