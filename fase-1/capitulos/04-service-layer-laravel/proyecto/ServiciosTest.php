<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';
require_once __DIR__ . '/servicios.php';

// Los tests de la CAPA DE SERVICIOS usan el RepositorioFalso: no tocan la base de datos.
final class ServiciosTest extends TestCase
{
    public function test_asignar_devuelve_la_referencia_del_lote(): void
    {
        $repo = new RepositorioFalso([new Lote('lote-1', 'LAMPARA', 100, null)]);
        $linea = new LineaPedido('o1', 'LAMPARA', 10);
        $this->assertSame('lote-1', servicioAsignar($linea, $repo, new SesionFalsa()));
    }

    public function test_asignar_lanza_error_si_el_sku_no_existe(): void
    {
        $repo = new RepositorioFalso([new Lote('lote-1', 'LAMPARA', 100, null)]);
        $linea = new LineaPedido('o1', 'INEXISTENTE', 10);
        $this->expectException(SkuInvalido::class);
        servicioAsignar($linea, $repo, new SesionFalsa());
    }

    public function test_asignar_hace_commit(): void
    {
        $repo = new RepositorioFalso([new Lote('lote-1', 'LAMPARA', 100, null)]);
        $sesion = new SesionFalsa();
        servicioAsignar(new LineaPedido('o1', 'LAMPARA', 10), $repo, $sesion);
        $this->assertTrue($sesion->comprometida);
    }
}
