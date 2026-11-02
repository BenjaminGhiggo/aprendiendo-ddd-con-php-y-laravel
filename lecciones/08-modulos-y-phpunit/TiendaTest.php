<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/Tienda.php';

final class TiendaTest extends TestCase {
    public function test_disponible_devuelve_el_stock(): void {
        $tienda = new Tienda(["MESA" => 20]);
        $this->assertSame(20, $tienda->disponible("MESA"));
    }

    public function test_disponible_de_un_sku_desconocido_es_cero(): void {
        $this->assertSame(0, (new Tienda())->disponible("NADA"));
    }

    public function test_asignar_reduce_el_stock(): void {
        $tienda = new Tienda(["MESA" => 20]);
        $this->assertSame(18, $tienda->asignar("MESA", 2));
    }

    public function test_asignar_de_mas_lanza_SinStock(): void {
        $tienda = new Tienda(["MESA" => 1]);
        $this->expectException(SinStockTienda::class);   // probar que LANZA (como pytest.raises)
        $tienda->asignar("MESA", 99);
    }
}
