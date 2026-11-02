<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/repositorio.php';

// Pruebas del repositorio: además de guardar/cargar, ahora RASTREA los productos vistos.
final class RepositorioTest extends BaseDeDatosTestCase
{
    public function test_agregar_y_obtener_marcan_visto(): void
    {
        $repo = new RepositorioEloquent();
        $repo->agregar(new Producto(['sku' => 'MESA']));
        $this->assertCount(1, $repo->vistos());

        $otro = new RepositorioEloquent();
        $otro->obtener('MESA'); // cargar también marca visto
        $this->assertCount(1, $otro->vistos());
    }

    public function test_el_repositorio_eloquent_carga_el_agregado_con_sus_lotes(): void
    {
        $producto = new Producto(['sku' => 'SOFA']);
        $repo = new RepositorioEloquent();
        $repo->agregar($producto);
        $producto->lotes()->create(['referencia' => 'l1', 'sku' => 'SOFA', 'cantidad_comprada' => 100]);
        $cargado = (new RepositorioEloquent())->obtener('SOFA');
        $this->assertSame(1, $cargado->lotes->count());
    }
}
