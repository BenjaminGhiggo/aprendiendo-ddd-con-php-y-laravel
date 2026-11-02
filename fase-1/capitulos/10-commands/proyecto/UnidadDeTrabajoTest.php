<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/BaseDeDatosTestCase.php';
require_once __DIR__ . '/unidad-de-trabajo.php';

// Pruebas de la Unit of Work: confirma, deshace y recolecta eventos de los productos vistos.
final class UnidadDeTrabajoTest extends BaseDeDatosTestCase
{
    public function test_comprometer_guarda_el_producto(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $uow->productos()->agregar(new Producto(['sku' => 'MESA']));
        $uow->comprometer();
        $this->assertNotNull(Producto::find('MESA'));
    }

    public function test_deshacer_no_guarda(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $uow->productos()->agregar(new Producto(['sku' => 'NO']));
        $uow->deshacer();
        $this->assertNull(Producto::find('NO'));
    }

    public function test_recolectar_vacia_los_eventos_de_los_productos_vistos(): void
    {
        $uow = new UnidadDeTrabajoEloquent();
        $producto = new Producto(['sku' => 'MESA']);
        $producto->eventos[] = new SinStock('MESA');
        $uow->productos()->agregar($producto);

        $nuevos = $uow->recolectarEventosNuevos();
        $this->assertCount(1, $nuevos);
        $this->assertInstanceOf(SinStock::class, $nuevos[0]);
        $this->assertSame([], $producto->eventos); // quedó vacío
    }
}
