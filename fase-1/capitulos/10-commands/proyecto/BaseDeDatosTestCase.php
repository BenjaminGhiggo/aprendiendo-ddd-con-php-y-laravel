<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';

// Clase base: arranca Eloquent con SQLite en memoria y crea el esquema antes de cada test.
// Cada test tiene una base limpia (Active Record idiomático en Laravel se prueba así).
abstract class BaseDeDatosTestCase extends TestCase
{
    protected function setUp(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        Capsule::schema()->create('lineas_pedido', function ($t) {
            $t->id();
            $t->string('id_pedido');
            $t->string('sku');
            $t->integer('cantidad');
        });
        Capsule::schema()->create('lotes', function ($t) {
            $t->id();
            $t->string('referencia');
            $t->string('sku');
            $t->integer('cantidad_comprada');
            $t->string('producto_sku')->nullable();
            $t->date('eta')->nullable();
        });
        Capsule::schema()->create('productos', function ($t) {
            $t->string('sku')->primary();
            $t->integer('numero_version')->default(0);
        });
        Capsule::schema()->create('asignaciones', function ($t) {
            $t->foreignId('lote_id');
            $t->foreignId('linea_pedido_id');
        });
    }

}
