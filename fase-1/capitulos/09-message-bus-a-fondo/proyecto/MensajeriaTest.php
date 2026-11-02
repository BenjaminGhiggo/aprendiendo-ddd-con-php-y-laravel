<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/mensajeria.php';

// Pruebas del BUS como punto de entrada y de la CASCADA de eventos.
final class MensajeriaTest extends BaseDeDatosTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Registros::$notificacionesSinStock = [];
        Registros::$asignacionesRegistradas = [];
    }

    private function crearProductoConLote(string $sku, string $ref, int $cantidad): void
    {
        $producto = new Producto(['sku' => $sku]);
        $producto->save();
        $producto->lotes()->create(['referencia' => $ref, 'sku' => $sku, 'cantidad_comprada' => $cantidad]);
    }

    public function test_asignar_por_el_bus_registra_la_asignacion(): void
    {
        $this->crearProductoConLote('MESA', 'l1', 100);
        manejar(new AsignacionRequerida('o1', 'MESA', 10), new UnidadDeTrabajoEloquent());
        // cascada: AsignacionRequerida -> (modelo) Asignado -> registrarAsignacion
        $this->assertSame(['l1'], Registros::$asignacionesRegistradas);
    }

    public function test_sin_stock_por_el_bus_notifica(): void
    {
        $this->crearProductoConLote('MESA', 'l1', 5);
        manejar(new AsignacionRequerida('o1', 'MESA', 10), new UnidadDeTrabajoEloquent()); // pide 10, hay 5
        // cascada: AsignacionRequerida -> (modelo) SinStock -> notificarSinStock
        $this->assertSame(['MESA'], Registros::$notificacionesSinStock);
    }

    public function test_sku_invalido_lanza_excepcion(): void
    {
        $this->expectException(SkuInvalido::class);
        manejar(new AsignacionRequerida('o1', 'NOEXISTE', 10), new UnidadDeTrabajoEloquent());
    }

    public function test_cambiar_cantidad_dispara_reasignacion_en_cascada(): void
    {
        $this->crearProductoConLote('MESA', 'l1', 50);
        $uow = new UnidadDeTrabajoEloquent();
        manejar(new AsignacionRequerida('o1', 'MESA', 50), $uow); // usa todo el lote
        // bajar el lote a 30 deja -20: la línea de 50 ya no cabe y debe re-encolarse
        manejar(new CambiarCantidadLote('l1', 30), new UnidadDeTrabajoEloquent());
        // la primera asignación sí quedó registrada; la reasignación no cupo (no hay otro lote)
        $this->assertContains('l1', Registros::$asignacionesRegistradas);
        $this->assertContains('MESA', Registros::$notificacionesSinStock);
    }
}
