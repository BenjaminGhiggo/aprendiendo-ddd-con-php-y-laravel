<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Tests de la UoW REAL contra SQLite en memoria (el agregado completo, atómico).
final class UowTest extends BaseDeDatosTestCase
{
    public function test_la_uow_confirma_y_persiste_el_agregado(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $uow->ejecutar(function () use ($uow) {
            $uow->productos->agregar(Producto::crear('MESA', [
                new Lote(['referencia' => 'l1', 'sku' => 'MESA', 'cantidad_comprada' => 20, 'eta' => null]),
            ]));
            $uow->comprometer();
        });
        $this->assertSame(1, Capsule::table('productos')->where('sku', 'MESA')->count());
        $this->assertSame(1, Capsule::table('lotes')->where('referencia', 'l1')->count());
    }

    public function test_la_uow_deshace_si_no_se_confirma(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $uow->ejecutar(function () use ($uow) {
            $uow->productos->agregar(Producto::crear('NO', []));
            // NO llamamos comprometer() -> al terminar ejecutar(), se deshace (rollback)
        });
        $this->assertSame(0, Capsule::table('productos')->count());
    }
}
