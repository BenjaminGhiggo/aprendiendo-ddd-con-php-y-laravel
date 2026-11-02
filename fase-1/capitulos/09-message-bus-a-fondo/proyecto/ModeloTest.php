<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Pruebas del modelo: ahora registra Asignado en el éxito y AsignacionRequerida al reasignar.
final class ModeloTest extends BaseDeDatosTestCase
{
    private function producto(string $sku, string $ref, int $cantidad): Producto
    {
        $producto = new Producto(['sku' => $sku]);
        $producto->save();
        $producto->lotes()->create(['referencia' => $ref, 'sku' => $sku, 'cantidad_comprada' => $cantidad]);
        return Producto::with('lotes.asignaciones')->find($sku);
    }

    public function test_asignar_registra_evento_asignado(): void
    {
        $producto = $this->producto('MESA', 'l1', 100);
        $linea = LineaPedido::create(['id_pedido' => 'o1', 'sku' => 'MESA', 'cantidad' => 10]);
        $ref = $producto->asignar($linea);
        $this->assertSame('l1', $ref);
        $this->assertInstanceOf(Asignado::class, $producto->eventos[0]);
        $this->assertSame('l1', $producto->eventos[0]->referencia);
    }

    public function test_sin_stock_registra_evento_sin_stock(): void
    {
        $producto = $this->producto('MESA', 'l1', 5);
        $linea = LineaPedido::create(['id_pedido' => 'o1', 'sku' => 'MESA', 'cantidad' => 10]);
        $this->assertNull($producto->asignar($linea));
        $this->assertInstanceOf(SinStock::class, $producto->eventos[0]);
    }

    public function test_cambiar_cantidad_por_debajo_de_lo_asignado_registra_asignacion_requerida(): void
    {
        $producto = $this->producto('MESA', 'l1', 50);
        $linea = LineaPedido::create(['id_pedido' => 'o1', 'sku' => 'MESA', 'cantidad' => 50]);
        $producto->asignar($linea);
        $producto->eventos = []; // limpiamos el Asignado para mirar solo lo nuevo

        $producto->cambiarCantidadLote('l1', 30); // deja -20: hay que desasignar la línea
        $this->assertInstanceOf(AsignacionRequerida::class, $producto->eventos[0]);
        $this->assertSame(50, $producto->eventos[0]->cantidad);
    }
}
