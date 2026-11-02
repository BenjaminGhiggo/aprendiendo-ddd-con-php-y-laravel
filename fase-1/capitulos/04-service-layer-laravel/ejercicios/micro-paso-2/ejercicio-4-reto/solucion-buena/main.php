<?php
declare(strict_types=1);
// BUENA: devuelve estado + cuerpo estructurados; el test los inspecciona sin levantar un servidor.
final class AsignarController {
    /** @return array{estado:int, cuerpo:array<string,mixed>} */
    public function asignar(array $p): array {
        return ["estado" => 201, "cuerpo" => ["referencia" => "lote-1"]];
    }
}
$resp = (new AsignarController())->asignar(["sku" => "LAMPARA"]);
echo $resp["estado"] . "\n";                     // 201
echo $resp["cuerpo"]["referencia"] . "\n";       // lote-1
