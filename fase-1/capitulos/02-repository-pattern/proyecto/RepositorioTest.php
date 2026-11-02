<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/repositorio.php';

final class RepositorioTest extends BaseDeDatosTestCase
{
    public function test_el_repositorio_falso_agrega_y_obtiene_un_lote(): void
    {
        $lote = new Lote(['referencia' => 'lote-001', 'sku' => 'MESA', 'cantidad_comprada' => 20]);
        $repo = new RepositorioFalso([]);
        $repo->agregar($lote);
        $this->assertTrue($lote->equals($repo->obtener('lote-001')));
    }

    public function test_el_repositorio_falso_devuelve_null_si_no_existe(): void
    {
        $repo = new RepositorioFalso([]);
        $this->assertNull($repo->obtener('no-existe'));
    }

    public function test_el_repositorio_eloquent_guarda_un_lote(): void
    {
        $repo = new RepositorioEloquent();
        $repo->agregar(new Lote(['referencia' => 'lote-100', 'sku' => 'MESA', 'cantidad_comprada' => 20]));
        $cargado = $repo->obtener('lote-100');
        $this->assertNotNull($cargado);
        $this->assertSame('MESA', $cargado->sku);
        $this->assertSame(20, (int) $cargado->cantidad_comprada);
    }

    public function test_el_repositorio_eloquent_guarda_y_carga_un_lote_con_asignaciones(): void
    {
        $lote = new Lote(['referencia' => 'lote-001', 'sku' => 'SOFA', 'cantidad_comprada' => 100]);
        $lote->save();
        $linea = new LineaPedido(['id_pedido' => 'pedido-1', 'sku' => 'SOFA', 'cantidad' => 12]);
        $linea->save();
        $lote->asignar($linea);

        $repo = new RepositorioEloquent();
        $cargado = $repo->obtener('lote-001');
        $this->assertSame(88, $cargado->cantidadDisponible());
        $this->assertCount(1, $cargado->asignaciones);
    }
}
