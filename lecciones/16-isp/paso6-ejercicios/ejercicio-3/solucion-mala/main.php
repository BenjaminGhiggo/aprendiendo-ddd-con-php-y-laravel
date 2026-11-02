<?php
// Ej3 — MALA (funciona): "Trabajador" obliga a todos a tener trabajar() Y cobrarSueldo().
interface Trabajador {
    public function trabajar(): string;
    public function cobrarSueldo(): string;
}
final class Voluntario implements Trabajador {
    public function trabajar(): string { return "trabajando"; }
    public function cobrarSueldo(): string { throw new \Exception("no cobro"); } // forzado
}
echo (new Voluntario())->trabajar() . "\n";
