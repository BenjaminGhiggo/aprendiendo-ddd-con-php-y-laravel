<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/unidad-de-trabajo.php';

// Clase base: arranca Eloquent con SQLite en memoria y crea el esquema del agregado
// (productos + lotes) antes de cada test.
abstract class BaseDeDatosTestCase extends TestCase
{
    protected function setUp(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        Capsule::schema()->dropAllTables();
        Capsule::schema()->create('productos', function ($t) {
            $t->string('sku')->primary();
            $t->integer('numero_version');
        });
        Capsule::schema()->create('lotes', function ($t) {
            $t->id();
            $t->string('referencia');
            $t->string('sku');
            $t->integer('cantidad_comprada');
            $t->string('eta')->nullable();
            $t->string('producto_sku')->nullable();
        });
    }
}
