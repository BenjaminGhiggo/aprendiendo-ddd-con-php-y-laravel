<?php
// Ej2 — BUENA: una UoW agrupa repo + confirmación; el servicio solo pide comprometer.
final class Uow {
    public array $repo = [];
    public bool $comprometido = false;
    public function comprometer(): void { $this->comprometido = true; }
}
function agregar(Uow $uow, string $ref): void { $uow->repo[] = $ref; $uow->comprometer(); }
$uow = new Uow();
agregar($uow, "lote-1");
echo "confirmado: " . var_export($uow->comprometido, true) . "\n"; // true
