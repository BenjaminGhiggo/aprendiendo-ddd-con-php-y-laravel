<?php
use PHPUnit\Framework\TestCase;

// Para ver la referencia en VERDE, cambia este require a: /paso4-tu-turno-solucion.php
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase
{
    public function test_agregar_y_obtener(): void
    {
        $repo = new RepositorioMemoria();
        $repo->agregar("lote-001");
        $this->assertSame("lote-001", $repo->obtener(0));
    }

    public function test_agregar_varios_heredado(): void
    {
        $repo = new RepositorioMemoria();
        $repo->agregarVarios(["a", "b", "c"]);
        $this->assertSame("c", $repo->obtener(2));
    }

    public function test_es_un_repositorio_abstracto(): void
    {
        $this->assertInstanceOf(RepositorioAbstracto::class, new RepositorioMemoria());
    }
}
