<?php
declare(strict_types=1);
// MALA: controlador GORDO: valida, asigna y coordina todo dentro. Imposible de reutilizar/probar sin HTTP.
final class AsignarController {
    public function asignar(array $peticion): array {
        $sku = $peticion["sku"];
        $lotes = ["LAMPARA"];                 // logica de negocio aqui dentro
        if (!in_array($sku, $lotes, true)) {
            return ["estado" => 400];
        }
        return ["estado" => 201, "cuerpo" => ["referencia" => "lote-1"]];
    }
}
print_r((new AsignarController())->asignar(["sku" => "LAMPARA"]));
