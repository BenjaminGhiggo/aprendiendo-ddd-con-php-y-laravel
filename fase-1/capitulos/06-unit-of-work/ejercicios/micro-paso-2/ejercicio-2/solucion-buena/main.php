<?php
// Ej2-BUENA: la UoW solo conserva lo confirmado; lo no confirmado se descarta al terminar.
final class Uow {
    private array $pendiente = []; public array $confirmado = [];
    public function guardar(string $x): void { $this->pendiente[] = $x; }
    public function comprometer(): void { $this->confirmado = $this->pendiente; }
    public function ejecutar(callable $t): void { $this->pendiente = []; $t(); }
}
$u = new Uow();
$u->ejecutar(function () use ($u) { $u->guardar("x"); }); // sin comprometer
echo "confirmado: " . implode(",", $u->confirmado) . "\n"; // vacío
