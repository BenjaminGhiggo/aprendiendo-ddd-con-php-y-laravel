<?php
// paso3-tu-turno.php — PASO 3 de la Lección 13 (SRP · pair programming).
// La comprobación es con PHPUnit (TDD): los tests ya están en Paso3TuTurnoTest.php y
// empiezan en ROJO. Completa los // TODO hasta verlos en VERDE:
//   vendor/bin/phpunit lecciones/13-srp
// Pista: cada pieza debe tener UNA sola razón para cambiar (README §5, recetas S1 y S2).
// (Este archivo solo DEFINE clases/funciones; no ejecuta nada al nivel superior.)

final class Factura {
    public function __construct(public array $precios) {}
    public function total(): int {
        // TODO 1: devuelve la suma de $this->precios (receta S1). Pista: array_sum.
        throw new \Exception("TODO 1");
    }
}

function formatearFactura(Factura $factura): string {
    // TODO 2: devuelve "Total: " seguido del total de la factura.
    throw new \Exception("TODO 2");
}

final class RepositorioFacturas {
    // TODO 3: declara una propiedad privada $facturas inicializada como array vacío.

    public function guardar(Factura $factura): void {
        // TODO 4: agrega la factura a $this->facturas.
        throw new \Exception("TODO 4");
    }
    public function contar(): int {
        // TODO 5: devuelve cuántas facturas hay guardadas.
        throw new \Exception("TODO 5");
    }
}

// ¡OJO! No agregues métodos para imprimir ni para guardar dentro de Factura:
// los tests comprueban que Factura NO los tenga (eso sería violar el SRP).
