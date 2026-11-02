<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/mensajeria.php';

final class MensajeriaTest extends TestCase
{
    private function uowConProducto(int $cantidad = 100): UnidadDeTrabajoFalsa
    {
        $uow = new UnidadDeTrabajoFalsa();
        $uow->productos()->agregar(Producto::crear('MESA', [
            new Lote(['referencia' => 'l1', 'sku' => 'MESA', 'cantidad_comprada' => $cantidad, 'eta' => null]),
        ]));
        return $uow;
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

    public function test_sin_stock_registra_la_notificacion(): void
    {
        Bus::$notificacionesSinStock = [];
        $uow = $this->uowConProducto(5); // hay 5, se piden 10 -> SinStock
        Bus::manejar(new Asignar('o1', 'MESA', 10), $uow);
        $this->assertSame(['MESA'], Bus::$notificacionesSinStock);
    }
}
