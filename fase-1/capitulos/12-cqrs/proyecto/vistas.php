<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;

// vistas.php — el LADO DE LECTURA (CQRS). Lee de una tabla DESNORMALIZADA (asignaciones_vista),
// no del modelo de dominio. CQS: estas funciones solo responden preguntas, no cambian estado.
final class Vistas
{
    /** @return array<int, array{sku: string, referencia: string}> */
    public static function asignaciones(string $idPedido): array
    {
        $filas = Capsule::table('asignaciones_vista')
            ->where('id_pedido', $idPedido)
            ->get(['sku', 'referencia']);
        $salida = [];
        foreach ($filas as $fila) {
            $salida[] = ['sku' => $fila->sku, 'referencia' => $fila->referencia];
        }
        return $salida;
    }
}
