<?php
// Paso3TuTurnoTest.php — tests de tu turno (Lección 14 · OCP). Rojo → verde (TDD).
// Ejecuta:  vendor/bin/phpunit lecciones/14-ocp
// Para ver la referencia en verde, cambia el require a 'paso4-tu-turno-solucion.php'.
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase {
    public function test_descuento_vip_cobra_el_70_por_ciento(): void {
        $this->assertEquals(70, descuentoVip(100));
    }
    public function test_vip_registrado_y_el_nucleo_lo_usa_sin_cambios(): void {
        $this->assertEquals(70, precioConCodigo(100, "vip"));
    }
    public function test_los_descuentos_viejos_siguen_funcionando(): void {
        $this->assertEquals(90, precioConCodigo(100, "10"));
        $this->assertEquals(100, precioConCodigo(100, "ninguno"));
    }
    public function test_envio_express_cuesta_20(): void {
        $this->assertSame(20, (new EnvioExpress())->costo());
    }
    public function test_el_nucleo_de_envios_acepta_el_tipo_nuevo(): void {
        $this->assertSame(120, totalConEnvio(100, new EnvioExpress()));
        $this->assertSame(110, totalConEnvio(100, new EnvioNormal()));
    }
}
