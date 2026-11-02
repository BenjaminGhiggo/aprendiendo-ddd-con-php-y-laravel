<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';

// Las pruebas del dominio (TDD: se escriben primero). El Lote es un modelo Eloquent, pero como
// sus asignaciones viven EN MEMORIA, estos tests no necesitan base de datos: creamos el Lote con
// `new Lote([...])` (constructor de Eloquent) y no lo guardamos.
// Correr:  vendor/bin/phpunit fase-1/capitulos/05-tdd-marchas/proyecto
final class ModeloTest extends TestCase
{
    private function lote(string $ref, string $sku, int $cantidad, ?string $eta = null): Lote
    {
        return new Lote(['referencia' => $ref, 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta]);
    }

    /** @return array{Lote, LineaPedido} */
    private function hacerLoteYLinea(string $sku, int $cantidadLote, int $cantidadLinea): array
    {
        return [
            $this->lote('lote-001', $sku, $cantidadLote, '2025-01-01'),
            new LineaPedido('pedido-123', $sku, $cantidadLinea),
        ];
    }

    // --- Micro-paso 1 ---
    public function test_asignar_a_un_lote_reduce_la_cantidad_disponible(): void
    {
        $lote = $this->lote('lote-001', 'MESA-PEQUEÑA', 20, '2025-01-01');
        $lote->asignar(new LineaPedido('pedido-ref', 'MESA-PEQUEÑA', 2));
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    // --- Micro-paso 2 ---
    public function test_dos_lineas_con_los_mismos_datos_son_iguales(): void
    {
        $a = new LineaPedido('pedido-1', 'MESA', 2);
        $b = new LineaPedido('pedido-1', 'MESA', 2);
        $this->assertTrue($a->equals($b));
    }

    public function test_dos_lotes_con_la_misma_referencia_son_el_mismo(): void
    {
        $a = $this->lote('lote-001', 'MESA', 20, null);
        $b = $this->lote('lote-001', 'SILLA', 5, '2025-01-01');
        $this->assertTrue($a->equals($b));
    }

    // --- Micro-paso 3 ---
    public function test_puede_asignar_si_lo_disponible_es_mayor(): void
    {
        [$lote, $linea] = $this->hacerLoteYLinea('LAMPARA-ELEGANTE', 20, 2);
        $this->assertTrue($lote->puedeAsignar($linea));
    }

    public function test_no_puede_asignar_si_lo_disponible_es_menor(): void
    {
        [$lote, $linea] = $this->hacerLoteYLinea('LAMPARA-ELEGANTE', 2, 20);
        $this->assertFalse($lote->puedeAsignar($linea));
    }

    public function test_puede_asignar_si_lo_disponible_es_igual(): void
    {
        [$lote, $linea] = $this->hacerLoteYLinea('LAMPARA-ELEGANTE', 2, 2);
        $this->assertTrue($lote->puedeAsignar($linea));
    }

    public function test_no_puede_asignar_si_los_skus_no_coinciden(): void
    {
        $lote = $this->lote('lote-001', 'SILLA-INCOMODA', 100, null);
        $linea = new LineaPedido('pedido-123', 'TOSTADORA-CARA', 10);
        $this->assertFalse($lote->puedeAsignar($linea));
    }

    public function test_asignar_la_misma_linea_dos_veces_no_descuenta_doble(): void
    {
        [$lote, $linea] = $this->hacerLoteYLinea('MESA', 20, 2);
        $lote->asignar($linea);
        $lote->asignar($linea);
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_desasignar_una_linea_no_asignada_no_cambia_nada(): void
    {
        [$lote, $linea] = $this->hacerLoteYLinea('MESA', 20, 2);
        $lote->desasignar($linea);
        $this->assertSame(20, $lote->cantidadDisponible());
    }

    // --- Micro-paso 4 ---
    public function test_prefiere_lotes_en_stock_a_los_de_envio(): void
    {
        $enStock = $this->lote('lote-en-stock', 'RELOJ-RETRO', 100, null);
        $deEnvio = $this->lote('lote-de-envio', 'RELOJ-RETRO', 100, '2025-01-02');
        asignar(new LineaPedido('pedido-ref', 'RELOJ-RETRO', 10), [$enStock, $deEnvio]);
        $this->assertSame(90, $enStock->cantidadDisponible());
        $this->assertSame(100, $deEnvio->cantidadDisponible());
    }

    public function test_prefiere_los_lotes_con_eta_mas_temprana(): void
    {
        $temprano = $this->lote('lote-rapido', 'CUCHARA-MINIMALISTA', 100, '2025-01-01');
        $intermedio = $this->lote('lote-normal', 'CUCHARA-MINIMALISTA', 100, '2025-01-02');
        $ultimo = $this->lote('lote-lento', 'CUCHARA-MINIMALISTA', 100, '2025-01-11');
        asignar(new LineaPedido('pedido-1', 'CUCHARA-MINIMALISTA', 10), [$intermedio, $temprano, $ultimo]);
        $this->assertSame(90, $temprano->cantidadDisponible());
        $this->assertSame(100, $intermedio->cantidadDisponible());
        $this->assertSame(100, $ultimo->cantidadDisponible());
    }

    public function test_devuelve_la_referencia_del_lote_asignado(): void
    {
        $enStock = $this->lote('lote-en-stock-ref', 'POSTER-CULTO', 100, null);
        $deEnvio = $this->lote('lote-de-envio-ref', 'POSTER-CULTO', 100, '2025-01-02');
        $ref = asignar(new LineaPedido('pedido-ref', 'POSTER-CULTO', 10), [$enStock, $deEnvio]);
        $this->assertSame('lote-en-stock-ref', $ref);
    }

    public function test_lanza_sin_stock_si_no_se_puede_asignar(): void
    {
        $lote = $this->lote('lote-1', 'TENEDOR-PEQUENO', 10, '2025-01-01');
        asignar(new LineaPedido('pedido-1', 'TENEDOR-PEQUENO', 10), [$lote]);
        $this->expectException(SinStock::class);
        asignar(new LineaPedido('pedido-2', 'TENEDOR-PEQUENO', 1), [$lote]);
    }
}
