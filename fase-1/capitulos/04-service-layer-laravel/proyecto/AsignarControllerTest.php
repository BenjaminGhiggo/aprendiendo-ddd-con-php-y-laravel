<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';
require_once __DIR__ . '/servicios.php';
require_once __DIR__ . '/AsignarController.php';

final class AsignarControllerTest extends TestCase
{
    public function test_la_api_asigna_y_devuelve_201(): void
    {
        $repo = new RepositorioFalso([new Lote(['referencia' => 'lote-api', 'sku' => 'SOFA', 'cantidad_comprada' => 100, 'eta' => null])]);
        $controlador = new AsignarController($repo, new SesionFalsa());
        $resp = $controlador->asignar(['id_pedido' => 'o1', 'sku' => 'SOFA', 'cantidad' => 10]);
        $this->assertSame(201, $resp['estado']);
        $this->assertSame('lote-api', $resp['cuerpo']['referencia']);
    }

    public function test_la_api_devuelve_400_si_el_sku_no_existe(): void
    {
        $repo = new RepositorioFalso([new Lote(['referencia' => 'lote-api', 'sku' => 'SOFA', 'cantidad_comprada' => 100, 'eta' => null])]);
        $controlador = new AsignarController($repo, new SesionFalsa());
        $resp = $controlador->asignar(['id_pedido' => 'o1', 'sku' => 'INEXISTENTE', 'cantidad' => 10]);
        $this->assertSame(400, $resp['estado']);
    }
}
