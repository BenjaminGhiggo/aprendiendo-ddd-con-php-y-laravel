<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Tests del ORM: el agregado `Producto` se guarda y se carga CON sus lotes (hasMany).
final class PersistenciaTest extends BaseDeDatosTestCase
{
    public function test_guarda_y_carga_un_producto_con_lotes(): void
    {
        $producto = Producto::crear('MESA', [
            new Lote(['referencia' => 'l1', 'sku' => 'MESA', 'cantidad_comprada' => 20, 'eta' => null]),
        ]);
        (new RepositorioEloquent())->agregar($producto);

        $cargado = Producto::query()->with('lotes')->find('MESA');
        $this->assertNotNull($cargado);
        $this->assertSame('MESA', $cargado->sku);
        $this->assertCount(1, $cargado->lotes);
        $this->assertSame('l1', $cargado->lotes->first()->referencia);
    }

    public function test_persiste_el_numero_de_version(): void
    {
        $producto = Producto::crear('LAMPARA', [
            new Lote(['referencia' => 'l1', 'sku' => 'LAMPARA', 'cantidad_comprada' => 100, 'eta' => null]),
        ]);
        $producto->asignar(new LineaPedido('o1', 'LAMPARA', 10));   // numero_version -> 1
        (new RepositorioEloquent())->agregar($producto);

        $cargado = Producto::query()->find('LAMPARA');
        $this->assertSame(1, (int) $cargado->numero_version);
    }
}
