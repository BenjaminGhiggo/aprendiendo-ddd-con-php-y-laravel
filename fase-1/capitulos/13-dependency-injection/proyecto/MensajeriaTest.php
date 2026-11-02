<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/bootstrap.php';

// En el cap. 13 el bus ya no habla con un email concreto: usa la ABSTRACCIÓN Notificaciones
// que el bootstrap le inyecta. En los tests inyectamos la versión FALSA y comprobamos lo
// que "se envió" leyendo su array ->enviadas (sin imprimir ni mandar correos de verdad).
final class MensajeriaTest extends TestCase
{
    private function uowConProducto(int $cantidad = 100): UnidadDeTrabajoFalsa
    {
        $uow = new UnidadDeTrabajoFalsa();
        $uow->productos()->agregar(new Producto('MESA', [new Lote('l1', 'MESA', $cantidad, null)]));
        return $uow;
    }

    protected function tearDown(): void
    {
        Bus::$notificaciones = null; // deja el bus limpio para el siguiente test
    }

    public function test_comando_asignar_registra_la_asignacion(): void
    {
        Bus::$asignacionesRegistradas = [];
        Bus::manejar(new Asignar('o1', 'MESA', 10), $this->uowConProducto());
        $this->assertSame(['l1'], Bus::$asignacionesRegistradas);
    }

    public function test_los_errores_de_comandos_propagan(): void
    {
        $uow = new UnidadDeTrabajoFalsa(); // sin producto
        $this->expectException(SkuInvalido::class);
        Bus::manejar(new Asignar('o1', 'XXX', 10), $uow);
    }

    public function test_sin_stock_envia_por_la_dependencia_inyectada(): void
    {
        Bus::$notificacionesSinStock = [];
        $falsas = new NotificacionesFalsas();
        Bootstrap::arrancar($falsas);           // inyecta la falsa en el bus

        $uow = $this->uowConProducto(5);        // hay 5, se piden 10 -> SinStock
        Bus::manejar(new Asignar('o1', 'MESA', 10), $uow);

        $this->assertSame(['MESA'], Bus::$notificacionesSinStock);
        $this->assertSame(
            ['Sin stock para MESA'],
            $falsas->enviadas['stock@ejemplo.com'],
        );
    }
}
