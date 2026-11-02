<?php
// Paso3TuTurnoTest.php — tests de tu turno (Lección 16 · ISP). Rojo → verde.
// Ejecuta:  vendor/bin/phpunit lecciones/16-isp
// Para ver la referencia en verde, cambia el require a 'paso4-tu-turno-solucion.php'.
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase {
    public function test_respaldo_solo_usa_agregar(): void {
        $repo = new Repositorio();
        $this->assertSame("respaldado: L1", respaldo($repo, "L1"));
        $this->assertSame("L1", $repo->obtener("L1"));
    }
    public function test_repositorio_guarda_devuelve_y_null_si_no_esta(): void {
        $repo = new Repositorio();
        $repo->agregar("A");
        $this->assertSame("A", $repo->obtener("A"));
        $this->assertNull($repo->obtener("NO"));
    }
    public function test_solo_lectura_sirve_para_el_reporte(): void {
        $this->assertSame("Encontrado: solo-lectura:X", reporte(new SoloLectura(), "X"));
    }
    public function test_solo_lectura_no_carga_metodos_que_no_usa(): void {
        $solo = new SoloLectura();
        $this->assertInstanceOf(Lector::class, $solo);
        $this->assertNotInstanceOf(Escritor::class, $solo);
        $this->assertFalse(method_exists($solo, "agregar"));
    }
    public function test_repositorio_cumple_las_dos_interfaces(): void {
        $repo = new Repositorio();
        $this->assertInstanceOf(Lector::class, $repo);
        $this->assertInstanceOf(Escritor::class, $repo);
    }
}
