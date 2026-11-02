<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/servicios.php';

final class ServiciosTest extends BaseDeDatosTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        RegistroNotificaciones::$enviadas = [];
    }

    public function test_agregar_lote_crea_el_producto_si_no_existe(): void
    {
        agregarLote('lote-1', 'MESA', 100, null, new UnidadDeTrabajoEloquent());
        $this->assertNotNull(Producto::find('MESA'));
    }

    public function test_asignar_devuelve_la_referencia_del_lote(): void
    {
        agregarLote('lote-1', 'SOFA', 100, null, new UnidadDeTrabajoEloquent());
        $ref = asignarServicio('o1', 'SOFA', 10, new UnidadDeTrabajoEloquent());
        $this->assertSame('lote-1', $ref);
    }

    public function test_asignar_un_sku_que_no_existe_lanza_sku_invalido(): void
    {
        $this->expectException(SkuInvalido::class);
        asignarServicio('o1', 'NOEXISTE', 10, new UnidadDeTrabajoEloquent());
    }

    public function test_sin_stock_publica_una_notificacion_por_el_bus(): void
    {
        agregarLote('lote-1', 'MESA', 5, null, new UnidadDeTrabajoEloquent());
        asignarServicio('o1', 'MESA', 10, new UnidadDeTrabajoEloquent()); // pide 10, hay 5
        $this->assertSame(['MESA'], RegistroNotificaciones::$enviadas);
    }
}
