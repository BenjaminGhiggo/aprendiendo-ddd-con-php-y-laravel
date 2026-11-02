<?php
declare(strict_types=1);
// MALA: el controlador deja escapar la excepcion; el usuario recibe un 500 feo.
final class SkuInvalido extends \Exception {}
function servicioAsignar(string $sku): string {
    throw new SkuInvalido("Sku invalido {$sku}");
}
final class AsignarController {
    public function asignar(array $p): array {
        $ref = servicioAsignar($p["sku"]);   // si lanza, nadie la captura -> 500
        return ["estado" => 201, "cuerpo" => ["referencia" => $ref]];
    }
}
try {
    (new AsignarController())->asignar(["sku" => "NO"]);
} catch (SkuInvalido $e) {
    echo "500 sin controlar: " . $e->getMessage() . "\n";
}
