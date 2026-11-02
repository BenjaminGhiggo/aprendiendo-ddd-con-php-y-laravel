<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Con Active Record la lógica de dominio toca la BD, así que los tests usan SQLite en memoria.
final class ModeloTest extends BaseDeDatosTestCase
{
    private function productoConLote(string $sku, int $cantidad): Producto
    {
        $producto = Producto::create(['sku' => $sku]);
        $producto->lotes()->create(['referencia' => 'lote-1', 'sku' => $sku, 'cantidad_comprada' => $cantidad]);
        return $producto->fresh('lotes.asignaciones');
    }

    public function test_asignar_reduce_la_cantidad_disponible(): void
    {
        $producto = $this->productoConLote('MESA', 20);
        $linea = LineaPedido::create(['id_pedido' => 'o1', 'sku' => 'MESA', 'cantidad' => 2]);
        $producto->asignar($linea);
        $this->assertSame(18, $producto->fresh('lotes.asignaciones')->lotes->first()->cantidadDisponible());
    }

    public function test_asignar_sube_el_numero_de_version(): void
    {
        $producto = $this->productoConLote('MESA', 20);
        $producto->asignar(LineaPedido::create(['id_pedido' => 'o1', 'sku' => 'MESA', 'cantidad' => 2]));
        $this->assertSame(1, $producto->numero_version);
    }

    public function test_si_no_hay_stock_el_producto_acumula_el_evento_sin_stock(): void
    {
        $producto = $this->productoConLote('MESA', 1);
        $ref = $producto->asignar(LineaPedido::create(['id_pedido' => 'o1', 'sku' => 'MESA', 'cantidad' => 10]));
        $this->assertNull($ref);
        $this->assertCount(1, $producto->eventos);
        $this->assertInstanceOf(SinStock::class, $producto->eventos[0]);
        $this->assertSame('MESA', $producto->eventos[0]->sku);
    }
}
