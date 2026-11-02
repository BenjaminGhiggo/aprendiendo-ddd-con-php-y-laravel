<?php

declare(strict_types=1);

require_once __DIR__ . '/BaseDeDatosTestCase.php';

// Tests del dominio (ahora con Eloquent: cada modelo se guarda en SQLite en memoria).
final class ModeloTest extends BaseDeDatosTestCase
{
    private function linea(string $idPedido, string $sku, int $cantidad): LineaPedido
    {
        $l = new LineaPedido(['id_pedido' => $idPedido, 'sku' => $sku, 'cantidad' => $cantidad]);
        $l->save();
        return $l;
    }

    private function lote(string $ref, string $sku, int $cantidad, ?string $eta = null): Lote
    {
        $l = new Lote(['referencia' => $ref, 'sku' => $sku, 'cantidad_comprada' => $cantidad, 'eta' => $eta]);
        $l->save();
        return $l;
    }

    public function test_asignar_a_un_lote_reduce_la_cantidad_disponible(): void
    {
        $lote = $this->lote('lote-001', 'MESA-PEQUEÑA', 20, '2025-01-01');
        $lote->asignar($this->linea('pedido-ref', 'MESA-PEQUEÑA', 2));
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_dos_lotes_con_la_misma_referencia_son_el_mismo(): void
    {
        $a = $this->lote('lote-001', 'MESA', 20);
        $b = new Lote(['referencia' => 'lote-001', 'sku' => 'SILLA', 'cantidad_comprada' => 5]);
        $this->assertTrue($a->equals($b));
    }

    public function test_puede_asignar_si_lo_disponible_es_mayor(): void
    {
        $lote = $this->lote('lote-1', 'LAMPARA', 20);
        $this->assertTrue($lote->puedeAsignar($this->linea('p-1', 'LAMPARA', 2)));
    }

    public function test_no_puede_asignar_si_lo_disponible_es_menor(): void
    {
        $lote = $this->lote('lote-1', 'LAMPARA', 2);
        $this->assertFalse($lote->puedeAsignar($this->linea('p-1', 'LAMPARA', 20)));
    }

    public function test_no_puede_asignar_si_los_skus_no_coinciden(): void
    {
        $lote = $this->lote('lote-1', 'SILLA', 100);
        $this->assertFalse($lote->puedeAsignar($this->linea('p-1', 'TOSTADORA', 10)));
    }

    public function test_asignar_la_misma_linea_dos_veces_no_descuenta_doble(): void
    {
        $lote = $this->lote('lote-1', 'MESA', 20);
        $linea = $this->linea('p-1', 'MESA', 2);
        $lote->asignar($linea);
        $lote->asignar($linea);
        $this->assertSame(18, $lote->cantidadDisponible());
    }

    public function test_desasignar_una_linea_no_asignada_no_cambia_nada(): void
    {
        $lote = $this->lote('lote-1', 'MESA', 20);
        $lote->desasignar($this->linea('p-1', 'MESA', 2));
        $this->assertSame(20, $lote->cantidadDisponible());
    }

    public function test_prefiere_lotes_en_stock_a_los_de_envio(): void
    {
        $enStock = $this->lote('lote-en-stock', 'RELOJ', 100, null);
        $deEnvio = $this->lote('lote-de-envio', 'RELOJ', 100, '2025-01-02');
        asignar($this->linea('p-ref', 'RELOJ', 10), [$enStock, $deEnvio]);
        $this->assertSame(90, $enStock->cantidadDisponible());
        $this->assertSame(100, $deEnvio->cantidadDisponible());
    }

    public function test_prefiere_los_lotes_con_eta_mas_temprana(): void
    {
        $temprano = $this->lote('rapido', 'CUCHARA', 100, '2025-01-01');
        $intermedio = $this->lote('normal', 'CUCHARA', 100, '2025-01-02');
        $ultimo = $this->lote('lento', 'CUCHARA', 100, '2025-01-11');
        asignar($this->linea('p-1', 'CUCHARA', 10), [$intermedio, $temprano, $ultimo]);
        $this->assertSame(90, $temprano->cantidadDisponible());
        $this->assertSame(100, $intermedio->cantidadDisponible());
    }

    public function test_devuelve_la_referencia_del_lote_asignado(): void
    {
        $enStock = $this->lote('ref-stock', 'POSTER', 100, null);
        $deEnvio = $this->lote('ref-envio', 'POSTER', 100, '2025-01-02');
        $ref = asignar($this->linea('p-ref', 'POSTER', 10), [$enStock, $deEnvio]);
        $this->assertSame('ref-stock', $ref);
    }

    public function test_lanza_sin_stock_si_no_se_puede_asignar(): void
    {
        $lote = $this->lote('lote-1', 'TENEDOR', 10, '2025-01-01');
        asignar($this->linea('p-1', 'TENEDOR', 10), [$lote]);
        $this->expectException(SinStock::class);
        asignar($this->linea('p-2', 'TENEDOR', 1), [$lote]);
    }
}
