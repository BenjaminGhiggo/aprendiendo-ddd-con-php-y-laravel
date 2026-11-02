<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';

// Clase base: arranca Eloquent (Capsule) con SQLite en memoria y crea el esquema en cada test.
// Equivale al fixture `sesion` de pytest: cada test parte de una base limpia.
abstract class BaseDeDatosTestCase extends TestCase
{
    protected function setUp(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        Capsule::schema()->create('lineas_pedido', function ($tabla) {
            $tabla->id();
            $tabla->string('id_pedido');
            $tabla->string('sku');
            $tabla->integer('cantidad');
        });
        Capsule::schema()->create('lotes', function ($tabla) {
            $tabla->id();
            $tabla->string('referencia');
            $tabla->string('sku');
            $tabla->integer('cantidad_comprada');
            $tabla->string('eta')->nullable();
        });
        Capsule::schema()->create('asignaciones', function ($tabla) {
            $tabla->foreignId('lote_id');
            $tabla->foreignId('linea_pedido_id');
        });
    }

    protected function tearDown(): void
    {
        Capsule::schema()->dropAllTables();
    }
}
