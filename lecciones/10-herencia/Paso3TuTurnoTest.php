<?php
use PHPUnit\Framework\TestCase;

// Para ver la referencia en VERDE, cambia este require a: /paso4-tu-turno-solucion.php
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase
{
    public function test_empleado_cobra_su_base(): void
    {
        $this->assertSame(1000, (new Empleado(1000))->salario());
    }

    public function test_gerente_suma_el_bono(): void
    {
        $this->assertSame(1500, (new Gerente(1000, 500))->salario());
    }

    public function test_gerente_es_un_empleado(): void
    {
        $this->assertInstanceOf(Empleado::class, new Gerente(1000, 500));
    }
}
