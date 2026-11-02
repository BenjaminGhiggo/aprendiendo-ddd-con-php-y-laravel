<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Tests de la UoW REAL contra SQLite en memoria.
final class UowTest extends BaseDeDatosTestCase
{
    public function test_la_uow_confirma_y_persiste(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $uow->ejecutar(function () use ($uow) {
            $uow->lotes->agregar(new Lote(['referencia' => 'lote-uow', 'sku' => 'MESA', 'cantidad_comprada' => 20, 'eta' => null]));
            $uow->comprometer();
        });
        $this->assertSame(1, Capsule::table('lotes')->where('referencia', 'lote-uow')->count());
    }

    public function test_la_uow_deshace_si_no_se_confirma(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $uow->ejecutar(function () use ($uow) {
            $uow->lotes->agregar(new Lote(['referencia' => 'no-confirmado', 'sku' => 'MESA', 'cantidad_comprada' => 20, 'eta' => null]));
            // NO llamamos comprometer() -> al terminar ejecutar(), se deshace (rollback)
        });
        $this->assertSame(0, Capsule::table('lotes')->count());
    }
}
