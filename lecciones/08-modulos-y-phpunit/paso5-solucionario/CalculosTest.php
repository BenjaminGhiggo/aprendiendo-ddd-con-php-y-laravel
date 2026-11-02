<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/Calculos.php';

// Soluciones de los problemas de la Lección 08 como tests de PHPUnit.
final class CalculosTest extends TestCase {
    public function test_p1_sumar(): void { $this->assertSame(5, sumar(2, 3)); }       // 🟢 P1
    public function test_p2_es_par(): void { $this->assertTrue(esPar(4)); }             // 🟢 P2
    public function test_p3_no_es_par(): void { $this->assertFalse(esPar(7)); }         // 🟢 P3
    public function test_p4_mayor(): void { $this->assertSame(9, mayor(9, 3)); }        // 🟢 P4
    public function test_p5_sumar_negativos(): void { $this->assertSame(-1, sumar(-3, 2)); } // 🟡 P5
    public function test_p6_assertEquals(): void { $this->assertEquals("5", 5); }       // 🟡 P6 (== no ===)
    public function test_p7_lanza(): void {                                             // 🟡 P7
        require_once __DIR__ . '/../Tienda.php';
        $this->expectException(SinStockTienda::class);
        (new Tienda(["X" => 1]))->asignar("X", 5);
    }
    public function test_p8_array(): void { $this->assertSame([1, 2], [1, 2]); }        // 🟡 P8
}
