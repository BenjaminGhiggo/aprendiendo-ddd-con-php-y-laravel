<?php
declare(strict_types=1);
// BUENA: una Sesion inyectada; el servicio confirma al final (como session.commit() del libro).
interface Sesion { public function commit(): void; }
final class SesionFalsa implements Sesion {
    public bool $comprometida = false;
    public function commit(): void { $this->comprometida = true; }
}
function servicioAsignar(string $sku, Sesion $sesion): string {
    $referencia = "lote-1";   // ... asigno ...
    $sesion->commit();        // confirmo
    return $referencia;
}
$sesion = new SesionFalsa();
servicioAsignar("LAMPARA", $sesion);
echo ($sesion->comprometida ? "confirmado" : "sin confirmar") . "\n";   // confirmado
