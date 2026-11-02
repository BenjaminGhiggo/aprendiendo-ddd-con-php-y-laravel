<?php
// Paso3TuTurnoTest.php — tests de tu turno (Lección 15 · LSP). Rojo → verde.
// Ejecuta:  vendor/bin/phpunit lecciones/15-lsp
// Para ver la referencia en verde, cambia el require a 'paso4-tu-turno-solucion.php'.
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase {
    private function probarContrato(RepositorioAbstracto $repo): void {
        // El MISMO test para cualquier repositorio: un 'test de contrato'.
        $this->assertSame("L1", guardarYLeer($repo, "L1"));
        $this->assertNull($repo->obtener("NO-EXISTE"));
    }
    public function test_la_referencia_cumple_el_contrato(): void {
        $this->probarContrato(new RepositorioEnMemoria());
    }
    public function test_repositorio_lista_cumple_el_mismo_contrato(): void {
        $this->probarContrato(new RepositorioLista());
    }
    public function test_repositorio_lista_sustituye_a_la_referencia(): void {
        $real = new RepositorioEnMemoria();
        $lista = new RepositorioLista();
        foreach (["A", "B"] as $ref) { $real->agregar($ref); $lista->agregar($ref); }
        foreach (["A", "B", "C"] as $ref) { $this->assertSame($real->obtener($ref), $lista->obtener($ref)); }
    }
    public function test_cuadrado_calcula_su_area(): void {
        $this->assertSame(9, (new Cuadrado(3))->area());
    }
    public function test_cuadrado_es_figura_pero_no_rectangulo(): void {
        $cuadrado = new Cuadrado(3);
        $this->assertInstanceOf(Figura::class, $cuadrado);
        $this->assertNotInstanceOf(Rectangulo::class, $cuadrado);
    }
}
