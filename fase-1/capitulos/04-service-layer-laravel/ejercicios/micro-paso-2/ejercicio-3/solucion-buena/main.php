<?php
declare(strict_types=1);
// BUENA: el controlador CAPTURA la excepcion de dominio y la traduce a un 400 claro.
final class SkuInvalido extends \Exception {}
function servicioAsignar(string $sku): string {
    throw new SkuInvalido("Sku invalido {$sku}");
}
final class AsignarController {
    public function asignar(array $p): array {
        try {
            $ref = servicioAsignar($p["sku"]);
        } catch (SkuInvalido $e) {
            return ["estado" => 400, "cuerpo" => ["error" => $e->getMessage()]];
        }
        return ["estado" => 201, "cuerpo" => ["referencia" => $ref]];
    }
}
print_r((new AsignarController())->asignar(["sku" => "NO"]));   // estado 400
