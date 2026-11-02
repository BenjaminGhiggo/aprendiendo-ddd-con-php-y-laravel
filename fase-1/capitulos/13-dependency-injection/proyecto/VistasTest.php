<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/mensajeria.php';

final class VistasTest extends TestCase
{
    protected function setUp(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        Capsule::schema()->create('asignaciones_vista', function ($t) {
            $t->string('id_pedido');
            $t->string('sku');
            $t->string('referencia');
        });
    }

    protected function tearDown(): void
    {
        Capsule::schema()->drop('asignaciones_vista');
    }

    public function test_la_vista_muestra_las_asignaciones_del_pedido(): void
    {
        $uow = new UnidadDeTrabajoFalsa();
        Bus::manejar(new CrearLote('lote-mesa', 'MESA', 50, null), $uow);
        Bus::manejar(new Asignar('pedido1', 'MESA', 20), $uow);
        $this->assertSame(
            [['sku' => 'MESA', 'referencia' => 'lote-mesa']],
            Vistas::asignaciones('pedido1'),
        );
    }

    public function test_la_vista_de_un_pedido_sin_asignaciones_esta_vacia(): void
    {
        $this->assertSame([], Vistas::asignaciones('fantasma'));
    }
}
