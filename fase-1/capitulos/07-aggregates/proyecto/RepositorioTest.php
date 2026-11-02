<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Tests del repositorio de productos (un agregado = un repositorio).
final class RepositorioTest extends BaseDeDatosTestCase
{
    public function test_repo_falso_agrega_y_obtiene_un_producto(): void
    {
        $producto = Producto::crear('MESA', []);
        $repo = new RepositorioFalso([]);
        $repo->agregar($producto);
        $this->assertSame($producto, $repo->obtener('MESA'));
    }

    public function test_repo_falso_obtener_inexistente_es_null(): void
    {
        $this->assertNull((new RepositorioFalso([]))->obtener('NO-EXISTE'));
    }

    public function test_repo_eloquent_guarda_y_obtiene_el_agregado(): void
    {
        $repo = new RepositorioEloquent();
        $repo->agregar(Producto::crear('MESA', [
            new Lote(['referencia' => 'l1', 'sku' => 'MESA', 'cantidad_comprada' => 20, 'eta' => null]),
        ]));

        $cargado = $repo->obtener('MESA');
        $this->assertNotNull($cargado);
        $this->assertCount(1, $cargado->lotes);
    }
}
