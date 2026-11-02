<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

// Probamos las funciones de paso3-tu-turno.php. Empieza en ROJO hasta que completes los // TODO.
// Para ver la REFERENCIA en verde, cambia el require a 'paso4-tu-turno-solucion.php'.
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase {
    public function test_restar_stock(): void {
        $this->assertSame(18, restarStock(20, 2));
    }

    public function test_alcanza_cuando_hay_suficiente(): void {
        $this->assertTrue(alcanza(18, 5));
    }

    public function test_no_alcanza_cuando_falta(): void {
        $this->assertFalse(alcanza(3, 5));
    }
}
