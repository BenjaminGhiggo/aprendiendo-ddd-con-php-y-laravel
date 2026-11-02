<?php
declare(strict_types=1);
// MALA: probar una regla FINA en marcha alta (servicio): si falla, no sabes si es orden, repo o asignacion.
function servicioAsignar(string $sku): string {
    // ... mucha maquinaria intermedia ...
    return "lote-en-stock";   // por que gano este? el test de servicio no lo explica
}
$ref = servicioAsignar("LAMPARA");
echo ($ref === "lote-en-stock" ? "OK?" : "FALLO") . "\n";
