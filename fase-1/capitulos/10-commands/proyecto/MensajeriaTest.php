<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/mensajeria.php';

// Pruebas del BUS que distingue comandos de eventos (error propaga vs error aislado).
final class MensajeriaTest extends BaseDeDatosTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Registros::$notificacionesSinStock = [];
        Registros::$asignacionesRegistradas = [];
        configurarBus(); // restablece los mapas por defecto antes de cada test
    }

    private function crearProductoConLote(string $sku, string $ref, int $cantidad): void
    {
        $producto = new Producto(['sku' => $sku]);
        $producto->save();
        $producto->lotes()->create(['referencia' => $ref, 'sku' => $sku, 'cantidad_comprada' => $cantidad]);
    }

    public function test_comando_crear_lote_crea_el_producto(): void
    {
        manejar(new CrearLote('l1', 'MESA', 100, null), new UnidadDeTrabajoEloquent());
        $this->assertNotNull(Producto::find('MESA'));
    }

    public function test_comando_asignar_registra_la_asignacion(): void
    {
        $this->crearProductoConLote('MESA', 'l1', 100);
        manejar(new Asignar('o1', 'MESA', 10), new UnidadDeTrabajoEloquent());
        $this->assertSame(['l1'], Registros::$asignacionesRegistradas);
    }

    public function test_el_error_de_un_comando_propaga(): void
    {
        $this->expectException(SkuInvalido::class); // sku inexistente: el error SUBE
        manejar(new Asignar('o1', 'NOEXISTE', 10), new UnidadDeTrabajoEloquent());
    }

    public function test_el_error_de_un_evento_se_aisla(): void
    {
        $this->crearProductoConLote('MESA', 'l1', 100);
        // añadimos un manejador de evento que revienta ANTES del bueno:
        array_unshift(Bus::$evento[Asignado::class], function (): void {
            throw new \RuntimeException('boom');
        });
        manejar(new Asignar('o1', 'MESA', 10), new UnidadDeTrabajoEloquent());
        // pese al handler que reventó, el comando terminó y el buen handler corrió:
        $this->assertSame(['l1'], Registros::$asignacionesRegistradas);
    }

    public function test_cambiar_cantidad_dispara_reasignacion_en_cascada(): void
    {
        $this->crearProductoConLote('MESA', 'l1', 50);
        manejar(new Asignar('o1', 'MESA', 50), new UnidadDeTrabajoEloquent());
        // bajar el lote a 30 desasigna la línea de 50 (evento Desasignado -> reasignar)
        manejar(new CambiarCantidadLote('l1', 30), new UnidadDeTrabajoEloquent());
        // sin otro lote, la reasignación no cabe -> SinStock
        $this->assertContains('MESA', Registros::$notificacionesSinStock);
    }
}
