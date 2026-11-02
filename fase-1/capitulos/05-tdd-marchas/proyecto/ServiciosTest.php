<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';
require_once __DIR__ . '/servicios.php';

// MARCHA ALTA (nivel servicio): el test usa SOLO primitivos y el repositorio; no importa el
// modelo de dominio. Está desacoplado de cómo se construyen Lote/LineaPedido por dentro.
final class ServiciosTest extends TestCase
{
    public function test_asignar_devuelve_la_referencia(): void
    {
        $repo = new RepositorioFalso([]);
        agregarLote('lote-1', 'LAMPARA', 100, null, $repo, new SesionFalsa());
        $ref = servicioAsignar('o1', 'LAMPARA', 10, $repo, new SesionFalsa());
        $this->assertSame('lote-1', $ref);
    }

    public function test_asignar_lanza_error_si_el_sku_no_existe(): void
    {
        $repo = new RepositorioFalso([]);
        agregarLote('lote-1', 'LAMPARA', 100, null, $repo, new SesionFalsa());
        $this->expectException(SkuInvalido::class);
        servicioAsignar('o1', 'INEXISTENTE', 10, $repo, new SesionFalsa());
    }

    public function test_agregar_lote_hace_commit(): void
    {
        $repo = new RepositorioFalso([]);
        $sesion = new SesionFalsa();
        agregarLote('lote-1', 'LAMPARA', 100, null, $repo, $sesion);
        $this->assertTrue($sesion->comprometida);
    }
}
