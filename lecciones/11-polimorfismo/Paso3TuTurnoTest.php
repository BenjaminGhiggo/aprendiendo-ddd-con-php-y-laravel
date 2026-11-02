<?php
use PHPUnit\Framework\TestCase;

// Para ver la referencia en VERDE, cambia este require a: /paso4-tu-turno-solucion.php
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase
{
    public function test_area_del_rectangulo(): void
    {
        $this->assertSame(6.0, (new Rectangulo(2, 3))->area());
    }

    public function test_area_del_triangulo(): void
    {
        $this->assertSame(6.0, (new Triangulo(4, 3))->area());
    }

    public function test_ambos_son_figuras(): void
    {
        $this->assertInstanceOf(Figura::class, new Rectangulo(1, 1));
        $this->assertInstanceOf(Figura::class, new Triangulo(1, 1));
    }

    public function test_area_total_suma_cualquier_figura(): void
    {
        $this->assertSame(12.0, areaTotal([new Rectangulo(2, 3), new Triangulo(4, 3)]));
    }
}
