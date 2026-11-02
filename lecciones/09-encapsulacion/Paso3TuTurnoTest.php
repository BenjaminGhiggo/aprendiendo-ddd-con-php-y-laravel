<?php
use PHPUnit\Framework\TestCase;

// Para ver la referencia en VERDE, cambia este require a: /paso4-tu-turno-solucion.php
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase
{
    public function test_guarda_la_cantidad(): void
    {
        $lote = new LoteSeguro(20);
        $this->assertSame(20, $lote->disponible());
    }

    public function test_rechaza_cantidad_negativa(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new LoteSeguro(-5);
    }

    public function test_asignar_descuenta(): void
    {
        $lote = new LoteSeguro(20);
        $lote->asignar(5);
        $this->assertSame(15, $lote->disponible());
    }

    public function test_no_asigna_mas_de_lo_disponible(): void
    {
        $this->expectException(\DomainException::class);
        (new LoteSeguro(10))->asignar(999);
    }
}
