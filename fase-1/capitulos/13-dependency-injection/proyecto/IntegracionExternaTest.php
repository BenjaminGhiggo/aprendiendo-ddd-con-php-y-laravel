<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/mensajeria.php';

final class IntegracionExternaTest extends TestCase
{
    private function uowConProducto(int $cantidad = 100): UnidadDeTrabajoFalsa
    {
        $uow = new UnidadDeTrabajoFalsa();
        $uow->productos()->agregar(Producto::crear('MESA', [
            new Lote(['referencia' => 'l1', 'sku' => 'MESA', 'cantidad_comprada' => $cantidad, 'eta' => null]),
        ]));
        return $uow;
    }

    public function test_al_asignar_se_publica_un_evento_externo(): void
    {
        ColaExterna::limpiar();
        Bus::manejar(new Asignar('o1', 'MESA', 10), $this->uowConProducto());
        $this->assertSame(
            [['linea_asignada', ['id_pedido' => 'o1', 'sku' => 'MESA', 'ref' => 'l1']]],
            ColaExterna::$mensajesPublicados,
        );
    }

    public function test_un_mensaje_externo_se_consume_como_comando_interno(): void
    {
        $uow = $this->uowConProducto(50);
        Bus::manejar(new Asignar('o1', 'MESA', 50), $uow);   // usa todo
        // llega un mensaje externo pidiendo bajar la cantidad del lote
        Bus::consumirExterno(['referencia' => 'l1', 'cantidad' => 30], $uow);
        // el lote baja a 30; el producto registró Desasignado y el bus reasignó (SinStock interno)
        $lote = $uow->productos()->obtener('MESA')->lotes[0];
        $this->assertSame(30, (int) $lote->cantidad_comprada);
    }
}
