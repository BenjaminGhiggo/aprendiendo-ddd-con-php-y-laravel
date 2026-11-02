<?php
// paso4-tu-turno-solucion.php — PASO 4 de la Lección 14: solución de referencia.
// Las funciones "NÚCLEO (cerrado)" son IDÉNTICAS a paso3.
function sinDescuento(float $precio): float { return $precio; }
function descuento10(float $precio): float { return $precio * 0.9; }

final class Descuentos {
    /** @var array<string, callable> */
    public static array $mapa = [];
}
Descuentos::$mapa["ninguno"] = 'sinDescuento';
Descuentos::$mapa["10"] = 'descuento10';

function precioConCodigo(float $precio, string $codigo): float {
    return (Descuentos::$mapa[$codigo])($precio);
}

function descuentoVip(float $precio): float {
    return $precio * 70 / 100;                 // TODO 1
}
Descuentos::$mapa["vip"] = 'descuentoVip';     // TODO 2

abstract class Envio { abstract public function costo(): int; }
final class EnvioNormal extends Envio { public function costo(): int { return 10; } }
final class EnvioExpress extends Envio {
    public function costo(): int { return 20; }  // TODO 3
}
function totalConEnvio(int $precio, Envio $envio): int {
    return $precio + $envio->costo();
}
