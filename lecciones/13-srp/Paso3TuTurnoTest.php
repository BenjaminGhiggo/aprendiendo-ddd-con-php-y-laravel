<?php
// Paso3TuTurnoTest.php — los tests de tu turno (Lección 13 · SRP).
// Empiezan en ROJO a propósito (TDD): pasan a VERDE cuando completas los // TODO de paso3.
// Ejecuta:  vendor/bin/phpunit lecciones/13-srp
//
// Para ver la referencia en verde, cambia el require a 'paso4-tu-turno-solucion.php'.
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase {
    public function test_la_factura_calcula_su_total(): void {
        $this->assertSame(60, (new Factura([10, 20, 30]))->total());
    }
    public function test_formatear_factura_arma_el_texto(): void {
        $this->assertSame("Total: 60", formatearFactura(new Factura([10, 20, 30])));
    }
    public function test_el_repositorio_guarda_y_cuenta(): void {
        $repo = new RepositorioFacturas();
        $repo->guardar(new Factura([1]));
        $repo->guardar(new Factura([2]));
        $this->assertSame(2, $repo->contar());
    }
    public function test_la_factura_no_tiene_otras_responsabilidades(): void {
        // SRP: Factura NO debe saber imprimirse ni guardarse.
        $this->assertFalse(method_exists(Factura::class, "guardar"));
        $this->assertFalse(method_exists(Factura::class, "imprimir"));
        $this->assertFalse(method_exists(Factura::class, "formatear"));
    }
}
