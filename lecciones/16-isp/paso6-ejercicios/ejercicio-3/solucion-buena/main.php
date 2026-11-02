<?php
// Ej3 — BUENA: separar las capacidades; cada quien implementa lo suyo.
interface Trabaja { public function trabajar(): string; }
interface Cobra   { public function cobrarSueldo(): string; }
final class Voluntario implements Trabaja {
    public function trabajar(): string { return "trabajando"; }
}
final class Empleado implements Trabaja, Cobra {
    public function trabajar(): string { return "trabajando"; }
    public function cobrarSueldo(): string { return "cobrando"; }
}
echo (new Voluntario())->trabajar() . "\n";
echo (new Empleado())->cobrarSueldo() . "\n";
