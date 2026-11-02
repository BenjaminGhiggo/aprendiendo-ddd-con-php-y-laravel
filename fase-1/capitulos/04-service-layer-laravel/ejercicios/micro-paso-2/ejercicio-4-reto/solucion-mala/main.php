<?php
declare(strict_types=1);
// MALA: el controlador imprime/HTML directamente; el test no puede inspeccionar estado ni cuerpo.
final class AsignarController {
    public function asignar(array $p): void {
        echo "HTTP 201 Created\n";          // mezcla la respuesta con el formato de salida
        echo "referencia: lote-1\n";
    }
}
(new AsignarController())->asignar(["sku" => "LAMPARA"]);
