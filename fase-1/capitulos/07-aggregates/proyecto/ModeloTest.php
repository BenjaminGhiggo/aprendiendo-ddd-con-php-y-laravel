<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';

// Tests del dominio (sin base de datos: lotes y asignaciones en memoria).
final class ModeloTest extends TestCase
{
    private function lote(string $referencia, string $sku, int $cantidad, ?string $eta = null): Lote
    {
        return new Lote(['referencia' => $referencia, 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta]);
    }

    // --- Lote (igual que en capítulos anteriores) ---
    public function test_asignar_reduce_la_cantidad_disponible(): void
    {
        $lote = $this->lote('l1', 'MESA', 20);
        $lote->asignar(new LineaPedido('o1', 'MESA', 2));
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_no_descuenta_doble_la_misma_linea(): void
    {
        $lote = $this->lote('l1', 'MESA', 20);
        $linea = new LineaPedido('o1', 'MESA', 2);
        $lote->asignar($linea);
        $lote->asignar($linea);
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_sku_distinto_no_puede_asignar(): void
    {
        $this->assertFalse($this->lote('l1', 'MESA', 100)->puedeAsignar(new LineaPedido('o1', 'TOSTADORA', 1)));
    }

    public function test_el_servicio_de_dominio_prefiere_almacen(): void
    {
        $enStock = $this->lote('en-stock', 'RELOJ', 100, null);
        $deEnvio = $this->lote('de-envio', 'RELOJ', 100, '2025-01-02');
        $ref = asignar(new LineaPedido('o1', 'RELOJ', 10), [$deEnvio, $enStock]);
        $this->assertSame('en-stock', $ref);
    }

    public function test_sin_stock(): void
    {
        $this->expectException(SinStock::class);
        asignar(new LineaPedido('o1', 'MESA', 999), [$this->lote('l1', 'MESA', 1)]);
    }

    // --- Agregado Producto (nuevo en el cap. 7) ---
    public function test_el_producto_asigna_y_sube_el_numero_de_version(): void
    {
        $producto = Producto::crear('LAMPARA', [$this->lote('l1', 'LAMPARA', 100)]);
        $producto->asignar(new LineaPedido('o1', 'LAMPARA', 10));
        $this->assertSame(1, (int) $producto->numero_version);
    }

    public function test_el_producto_elige_el_lote_en_almacen(): void
    {
        $producto = Producto::crear('RELOJ', [
            $this->lote('de-envio', 'RELOJ', 100, '2025-01-02'),
            $this->lote('en-stock', 'RELOJ', 100, null),
        ]);
        $this->assertSame('en-stock', $producto->asignar(new LineaPedido('o1', 'RELOJ', 10)));
    }

    public function test_el_producto_lanza_sin_stock_si_no_puede(): void
    {
        $producto = Producto::crear('LAMPARA', [$this->lote('l1', 'LAMPARA', 10)]);
        $producto->asignar(new LineaPedido('o1', 'LAMPARA', 10));
        $this->expectException(SinStock::class);
        $producto->asignar(new LineaPedido('o2', 'LAMPARA', 1));
    }
}
