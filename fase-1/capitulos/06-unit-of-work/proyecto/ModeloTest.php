<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';

// Tests del dominio (sin base de datos: las asignaciones del Lote están en memoria).
final class ModeloTest extends TestCase
{
    private function lote(string $sku, int $cantidad, ?string $eta = null): Lote
    {
        return new Lote(['referencia' => 'lote-001', 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta]);
    }

    public function test_asignar_reduce_la_cantidad_disponible(): void
    {
        $lote = $this->lote('MESA', 20);
        $lote->asignar(new LineaPedido('o1', 'MESA', 2));
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_no_descuenta_doble_la_misma_linea(): void
    {
        $lote = $this->lote('MESA', 20);
        $linea = new LineaPedido('o1', 'MESA', 2);
        $lote->asignar($linea);
        $lote->asignar($linea);
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_sku_distinto_no_puede_asignar(): void
    {
        $this->assertFalse($this->lote('MESA', 100)->puedeAsignar(new LineaPedido('o1', 'TOSTADORA', 1)));
    }

    public function test_el_servicio_de_dominio_prefiere_almacen(): void
    {
        $enStock = $this->lote('RELOJ', 100, null);
        $enStock->referencia = 'en-stock';
        $deEnvio = new Lote(['referencia' => 'de-envio', 'sku' => 'RELOJ', 'cantidad_comprada' => 100, 'eta' => '2025-01-02']);
        $ref = asignar(new LineaPedido('o1', 'RELOJ', 10), [$deEnvio, $enStock]);
        $this->assertSame('en-stock', $ref);
    }

    public function test_sin_stock(): void
    {
        $this->expectException(SinStock::class);
        asignar(new LineaPedido('o1', 'MESA', 999), [$this->lote('MESA', 1)]);
    }
}
