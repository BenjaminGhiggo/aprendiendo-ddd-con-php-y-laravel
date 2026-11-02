<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/repositorio.php';

final class RepositorioTest extends BaseDeDatosTestCase
{
    public function test_el_repositorio_falso_guarda_y_obtiene(): void
    {
        $repo = new RepositorioFalso();
        $repo->agregar(new Producto(['sku' => 'MESA']));
        $this->assertSame('MESA', $repo->obtener('MESA')->sku);
        $this->assertNull($repo->obtener('NADA'));
    }

    public function test_el_repositorio_eloquent_guarda_y_carga_el_agregado(): void
    {
        $producto = new Producto(['sku' => 'SOFA']);
        $repo = new RepositorioEloquent();
        $repo->agregar($producto);
        $producto->lotes()->create(['referencia' => 'lote-1', 'sku' => 'SOFA', 'cantidad_comprada' => 100]);
        $cargado = $repo->obtener('SOFA');
        $this->assertSame('SOFA', $cargado->sku);
        $this->assertSame(1, $cargado->lotes->count());
    }
}
