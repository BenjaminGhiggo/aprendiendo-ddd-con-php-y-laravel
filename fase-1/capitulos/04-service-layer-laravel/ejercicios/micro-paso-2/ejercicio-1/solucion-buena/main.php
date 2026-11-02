<?php
declare(strict_types=1);
// BUENA: controlador FINO: solo traduce la peticion y delega en el servicio.
function servicioAsignar(string $sku): string {
    if ($sku !== "LAMPARA") { throw new \RuntimeException("sku"); }
    return "lote-1";
}
final class AsignarController {
    public function asignar(array $peticion): array {
        try {
            $ref = servicioAsignar($peticion["sku"]);   // delega
        } catch (\RuntimeException $e) {
            return ["estado" => 400];
        }
        return ["estado" => 201, "cuerpo" => ["referencia" => $ref]];
    }
}
print_r((new AsignarController())->asignar(["sku" => "LAMPARA"]));
