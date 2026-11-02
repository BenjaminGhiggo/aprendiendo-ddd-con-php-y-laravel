<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';

// Test de INTEGRACIÓN: el RepositorioEloquent de verdad, contra SQLite en memoria.
final class RepositorioEloquentTest extends TestCase
{
    protected function setUp(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        Capsule::schema()->create('lotes', function ($t): void {
            $t->id();
            $t->string('referencia');
            $t->string('sku');
            $t->integer('cantidad_comprada');
            $t->date('eta')->nullable();
        });
    }

    protected function tearDown(): void
    {
        Capsule::schema()->drop('lotes');
    }

    public function test_guarda_y_obtiene_un_lote(): void
    {
        $repo = new RepositorioEloquent();
        $repo->agregar(new Lote('lote-100', 'MESA', 20, null));
        $cargado = $repo->obtener('lote-100');
        $this->assertNotNull($cargado);
        $this->assertSame('MESA', $cargado->sku);
        $this->assertSame(20, $cargado->cantidadDisponible());
    }

    public function test_listar_devuelve_los_lotes_guardados(): void
    {
        $repo = new RepositorioEloquent();
        $repo->agregar(new Lote('lote-1', 'MESA', 10, null));
        $repo->agregar(new Lote('lote-2', 'SILLA', 5, null));
        $this->assertCount(2, $repo->listar());
    }
}
