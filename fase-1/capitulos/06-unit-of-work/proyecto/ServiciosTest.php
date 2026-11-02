<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/servicios.php';

// Tests de servicio con la UoW FALSA (en memoria, sin base de datos).
final class ServiciosTest extends TestCase
{
    public function test_agregar_lote_confirma(): void
    {
        $uow = new UnidadDeTrabajoFalsa();
        agregarLote('lote-1', 'LAMPARA', 100, null, $uow);
        $this->assertNotNull($uow->lotes->obtener('lote-1'));
        $this->assertTrue($uow->comprometido);
    }

    public function test_asignar_devuelve_la_referencia(): void
    {
        $uow = new UnidadDeTrabajoFalsa();
        agregarLote('lote-1', 'LAMPARA', 100, null, $uow);
        $this->assertSame('lote-1', asignarServicio('o1', 'LAMPARA', 10, $uow));
    }

    public function test_asignar_error_si_sku_invalido(): void
    {
        $uow = new UnidadDeTrabajoFalsa();
        agregarLote('lote-1', 'LAMPARA', 100, null, $uow);
        $this->expectException(SkuInvalido::class);
        asignarServicio('o1', 'INEXISTENTE', 10, $uow);
    }
}
