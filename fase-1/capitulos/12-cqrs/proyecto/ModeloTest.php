<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';

// El Producto y el Lote son modelos Eloquent, pero sus lotes/asignaciones viven en memoria, así
// que estos tests no necesitan base de datos: se construyen con `Producto::crear(...)` y
// `new Lote([...])` sin guardar.
final class ModeloTest extends TestCase
{
    private function lote(string $ref, string $sku, int $cantidad, ?string $eta = null): Lote
    {
        return new Lote(['referencia' => $ref, 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta]);
    }

    public function test_el_producto_asigna_y_registra_evento(): void
    {
        $producto = Producto::crear('MESA', [$this->lote('l1', 'MESA', 20, null)]);
        $ref = $producto->asignar(new LineaPedido('o1', 'MESA', 2));
        $this->assertSame('l1', $ref);
        $this->assertSame(18, $producto->lotes[0]->cantidadDisponible());
        $this->assertInstanceOf(Asignado::class, $producto->eventos[0]);
    }

    public function test_sin_stock_registra_evento_sin_stock(): void
    {
        $producto = Producto::crear('MESA', [$this->lote('l1', 'MESA', 5, null)]);
        $ref = $producto->asignar(new LineaPedido('o1', 'MESA', 10));
        $this->assertNull($ref);
        $this->assertInstanceOf(EventoSinStock::class, $producto->eventos[0]);
    }

    public function test_cambiar_cantidad_lote_desasigna_si_hace_falta(): void
    {
        $producto = Producto::crear('MESA', [$this->lote('l1', 'MESA', 50, null)]);
        $producto->asignar(new LineaPedido('o1', 'MESA', 50));
        $producto->cambiarCantidadLote('l1', 30); // ahora sobran 20 asignados
        $this->assertSame(30, (int) $producto->lotes[0]->cantidad_comprada);
        $this->assertInstanceOf(Desasignado::class, end($producto->eventos));
    }
}
