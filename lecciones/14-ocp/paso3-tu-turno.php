<?php
// paso3-tu-turno.php — PASO 3 de la Lección 14 (OCP · pair programming).
// La comprobación es con PHPUnit (TDD): los tests ya están en Paso3TuTurnoTest.php y
// empiezan en ROJO. Completa los // TODO hasta verlos en VERDE:
//   vendor/bin/phpunit lecciones/14-ocp
// REGLA: NO edites las funciones marcadas "NÚCLEO (cerrado)". Lo nuevo se AGREGA (eso es el OCP).

function sinDescuento(float $precio): float { return $precio; }
function descuento10(float $precio): float { return $precio * 0.9; }

final class Descuentos {
    /** @var array<string, callable> */
    public static array $mapa = [];
}
Descuentos::$mapa["ninguno"] = 'sinDescuento';
Descuentos::$mapa["10"] = 'descuento10';

function precioConCodigo(float $precio, string $codigo): float {
    // NÚCLEO (cerrado): no lo edites.
    return (Descuentos::$mapa[$codigo])($precio);
}

function descuentoVip(float $precio): float {
    // TODO 1: devuelve el precio con 30 % de descuento (paga el 70 %): $precio * 70 / 100.
    throw new \Exception("TODO 1");
}

// TODO 2: registra descuentoVip en Descuentos::$mapa con la clave "vip" (receta O3).
//         (una sola línea, debajo de este comentario)

abstract class Envio {
    abstract public function costo(): int;
}
final class EnvioNormal extends Envio {
    public function costo(): int { return 10; }
}
final class EnvioExpress extends Envio {
    public function costo(): int {
        // TODO 3: el envío express cuesta 20 (receta O2).
        throw new \Exception("TODO 3");
    }
}
function totalConEnvio(int $precio, Envio $envio): int {
    // NÚCLEO (cerrado): no lo edites.
    return $precio + $envio->costo();
}
