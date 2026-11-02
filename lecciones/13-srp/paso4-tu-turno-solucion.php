<?php
// paso4-tu-turno-solucion.php — PASO 4 de la Lección 13: solución de referencia de paso3.
// Compárala con la tuya:
//   git diff --no-index lecciones/13-srp/paso3-tu-turno.php lecciones/13-srp/paso4-tu-turno-solucion.php

final class Factura {
    public function __construct(public array $precios) {}
    public function total(): int {
        return array_sum($this->precios);           // TODO 1
    }
}

function formatearFactura(Factura $factura): string {
    return "Total: " . $factura->total();           // TODO 2
}

final class RepositorioFacturas {
    private array $facturas = [];                    // TODO 3
    public function guardar(Factura $factura): void {
        $this->facturas[] = $factura;                // TODO 4
    }
    public function contar(): int {
        return count($this->facturas);               // TODO 5
    }
}
